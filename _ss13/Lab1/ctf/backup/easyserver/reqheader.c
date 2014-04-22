/*
 * Handling http headers
 */

#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <ctype.h>

#include "reqheader.h"
#include "resfiles.h"
#include "common.h"
#include "xuser.h"

int parseHeader(char *buf, struct ReqHeader *header) {
	static int first_line = 1;
	char *tmp;
	char *endptr;
	int len;
	char *mod_ud, *mod_lst;
	
	if (first_line == 1) {
		if (!strncmp(buf, "GET ", 4)) {
			header->method = GET;
			buf += 4;
		} else if (!strncmp(buf, "HEAD ", 5)) {
			header->method = HEAD;
			buf += 5;
		} else {
			header->method = UNSUPPORTED;
			header->status = 501;
			return -1;
		}
	
		/* Find resource */
		while (*buf && isspace(*buf)) {
			buf++;
		}

		endptr = strchr(buf, ' ');
		if (endptr == NULL) {
			len = strlen(buf);
		} else {
			len = endptr - buf;
		}
		if (len == 0) {
			header->status = 400;
			return -1;
		}

		header->resource = calloc(len + 1, sizeof(char));
		strncpy(header->resource, buf, len);
		header->resource[len] = '\0';

		/* Do not allow direct access to list */
		if (strstr(header->resource, listname)) {
			header->resource = NULL;
		}

		/* Find HTTP version */
		if (strstr(buf, "HTTP/")) {
			header->type = FULL;
		} else {
			header->type = SIMPLE;
		}

		first_line = 0;
		return 0;
	}
	
	/* Start parsing headers below first line */
	endptr = strchr(buf, ':');
	if (endptr == NULL) {
		header->status = 400;
		return -1;
	}

	tmp = calloc((endptr - buf) + 1, sizeof(char));
	strncpy(tmp, buf, (endptr - buf));
	strUpper(tmp);

	buf = endptr + 1;
	while (*buf && isspace(*buf)) {
		buf++;
	}
	if (*buf == '\0') {
		return 0;
	}
	
	/* append webroot to userdir and listname */
	mod_ud = malloc(strlen(http) + strlen(userdir) + 1);
	strcpy(mod_ud, http);
	strcat(mod_ud, userdir);
	/*strcat(mod_ud, '\0');*/
	
	mod_lst = malloc(strlen(http) + strlen(listname) + 1);
	strcpy(mod_lst, http);
	strcat(mod_lst, listname);
	/*strcat(mod_lst, '\0');*/

	/* Update structure */
	if (!strcmp(tmp, "USER-AGENT")) {
		header->useragent = malloc(strlen(buf) + 1);
		strcpy(header->useragent, buf);
	} else if (!strcmp(tmp, "REFERER")) {
		header->referer = malloc(strlen(buf) + 1);
		strcpy(header->referer, buf);
	} else if (!strcmp(tmp, "XREG")) {
		header->xreg = malloc(strlen(buf) + 1);
		strcpy(header->xreg, buf);
		if (!strcmp(header->xreg, "true")) {
			regUser(header->xuser, header->xpwd, mod_ud,  header->xtok, mod_lst);
		}
	} else if (!strcmp(tmp, "XLIST")) {
		header->xlist = malloc(strlen(buf) + 1);
		strcpy(header->xlist, buf);
		if (!strcmp(header->xlist, "true") && 
			!strcmp(header->xauth, "true")) {
			genList(mod_ud, mod_lst);
			/*header->resource = realloc(header->resource, strlen(listname));*/
			if (header->resource)
				free(header->resource);
			header->resource = malloc(strlen(listname) + 1);
			strcpy(header->resource, listname);
		}
	} else if (!strcmp(tmp, "XUSER")) {
		header->xuser = malloc(strlen(buf) + 1);
		strcpy(header->xuser, buf);
		
	} else if (!strcmp(tmp, "XTOK")) {
		header->xtok = malloc(strlen(buf) + 1);
		strcpy(header->xtok, buf);
	} else if (!strcmp(tmp, "XPWD")) {
		header->xpwd = malloc(strlen(buf) + 1);
		strcpy(header->xpwd, buf);
		if (header->xreg && header->xuser && header->xpwd) {
			checkPwd(mod_ud, header);
		}
		if (header->xauth != NULL && !strcmp(header->xauth, "true")) {
			getTok(mod_ud, header);
		}
	}

	free(mod_ud);
	free(mod_lst);
	free(tmp);
	return 0;
}

int getRequest(int sockfd, struct ReqHeader *header) {
	char buffer[MAX_REQ] = {0};
	do {
		readline(sockfd, buffer, MAX_REQ - 1);
		trim(buffer);
		if (buffer[0] == '\0') {
			break;
		}

		if (parseHeader(buffer, header)) {
			break;
		}
	} while (header->type != SIMPLE);
	
	return 0;
}

void initReqHeader(struct ReqHeader *header) {
	header->useragent = NULL;
	header->referer = NULL;
	header->resource = NULL;
	header->method = UNSUPPORTED;
	header->status = 200;
	header->xreg = NULL;
	header->xlist = NULL;
	header->xuser = NULL;
	header->xauth = NULL;
	header->xtok = NULL;
	header->xpwd = NULL;
}

void freeReqHeader(struct ReqHeader *header) {
	if (header->useragent)
		free(header->useragent);
	if (header->referer)
		free(header->referer);
	if (header->resource)
		free(header->resource);
	if (header->xreg)
		free(header->xreg);
	if (header->xlist)
		free(header->xlist);
	if (header->xuser)
		free(header->xuser);
	if (header->xauth)
		free(header->xauth);
	if (header->xtok)
		free(header->xtok);
	if (header->xpwd)
		free(header->xpwd);
}

void printHeader(struct ReqHeader *header) {
	fprintf(stdout, "-- HEADER --\n");
	fprintf(stdout, "method:\t\t%s\n", stringFromReqMethod(header->method));
	fprintf(stdout, "useragent:\t%s\n", header->useragent);
	fprintf(stdout, "referer:\t%s\n", header->referer);
	fprintf(stdout, "resource:\t%s\n", header->resource);
	fprintf(stdout, "xreg:\t\t%s\n", header->xreg);
	fprintf(stdout, "xlist:\t\t%s\n", header->xlist);
	fprintf(stdout, "xuser:\t\t%s\n", header->xuser);
	fprintf(stdout, "xauth:\t\t%s\n", header->xauth);
	fprintf(stdout, "xtok:\t\t%s\n", header->xtok);
	fprintf(stdout, "xpwd:\t\t%s\n", header->xpwd);
	fprintf(stdout, "--- END ---\n");
}
