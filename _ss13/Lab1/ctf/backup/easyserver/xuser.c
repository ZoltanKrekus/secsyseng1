#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <dirent.h>
#include <sys/stat.h>

#include "common.h"
#include "xuser.h"
#include "reqheader.h"
#include "resfiles.h"

#define FILE_MAX (2048)

void initUser(struct XUser *user) {
	user->name = NULL;
	user->pwd = NULL;
	user->token = NULL;
}

void freeUser(struct XUser *user) {
	if (user->name)
		free(user->name);
	if (user->pwd)
		free(user->pwd);
	if (user->token)
		free(user->token);
}

void printUser(struct XUser *user) {
	fprintf(stdout, "-- USER -- \n");
	fprintf(stdout, "name:\t\t%s\n", user->name);
	fprintf(stdout, "Pwd:\t\t%s\n", user->pwd);
	fprintf(stdout, "Token:\t\t%s\n", user->token);
}

int checkPwd(char *path, struct ReqHeader *header) {
	FILE *file;
	char *fname;
	char *buf = "true";
	struct stat statbuf;

	if (!strcmp(header->xreg, "false")) {
		fname = malloc(strlen(path) + strlen(header->xuser) + strlen(header->xpwd) + 2);
		strcpy(fname, path);
		strcat(fname, header->xuser);
		strcat(fname, "-");
		strcat(fname, header->xpwd);
		/*if (xfopen(fname, "r")) {*/
		if (stat(fname, &statbuf) == 0) {
			header->xauth = malloc(strlen(buf) + 1);
			strcpy(header->xauth, buf);
		}
		free(fname);

		return 0;
	}

	return -1;
}

int regUser(char *name, char *pwd, char *path, char *token, char *listname) {
	int i;
	FILE *file;
	char *fname;


	if (name != NULL && pwd != NULL) {
		if (strstr(name, "-")) {
			return -1;
		}
		if (strstr(pwd, "-")) {
			return -1;
		}

		fname = malloc(strlen(path) + strlen(name) + strlen(pwd) + 2);
		strcpy(fname, path);
		strcat(fname, name);
		strcat(fname, "-");
		strcat(fname, pwd);
		file = fopen(fname, "w");

		fprintf(file, "<html>\n<head><title>");
		fprintf(file, "%s", name);
		fprintf(file, "</title></head>\n<body>\n<p>");
		fprintf(file, "%s", token);
		fprintf(file, "</p>\n</body>\n</html>\n");

		fclose(file);
		free(fname);

		/*genList(path, listname);*/

		return 0;
	}

	return -1;
}

int genList(char *path, char *fname) {
	DIR *d;
	FILE *f;
	struct dirent *dir;
	char *endptr;
	char buf[FILE_MAX], tmp[FILE_MAX];
	int len;

	d = opendir(path);

	if (d) {
		f = fopen(fname, "w");
		while ((dir = readdir(d)) != NULL) {
			memset(buf, '\0', FILE_MAX);
			memset(tmp, '\0', FILE_MAX);
/*TODO DEBUG printf("DIR: %s\n", dir->d_name);*/
			strncpy(tmp, dir->d_name, FILE_MAX - 1);
			tmp[FILE_MAX-1] = '\0';
			endptr = strstr(tmp, "-");
			if (endptr) {
				len = endptr - tmp;
				if (len >= FILE_MAX - 2)
					len = FILE_MAX - 2;
				strncpy(buf, dir->d_name, len);
				buf[len+1] = '\0';
/*TODO DEBUG printf("BUF: %s\n", buf);*/

				fprintf(f, "%s\n", buf);

			}

			endptr = NULL;
		}

		fclose(f);
		closedir(d);
	}

	return 0;
}

int getTok(char *path, struct ReqHeader *header) {
	DIR *d;
	struct dirent *dir;
	char *buf, *tmp;

	if (header->xauth != NULL && !strcmp(header->xauth, "true")) {
		d = opendir(path);
		if (d) {
			while ((dir = readdir(d)) != NULL) {
				if (!strncmp(header->xuser, dir->d_name, strlen(header->xuser))) {
					buf = malloc(strlen(path) + strlen(dir->d_name));
					/*printf("DIR: %s\n", dir->d_name);*/
					strcpy(buf, path);
					strcat(buf, dir->d_name);
/*					printf("BUF: %s\n", buf);*/
/*					printf("OLD RES: %s\n", header->resource);*/
					/* cut the webroot, will be appended later */
					if (tmp = strstr(buf, http)) {
						tmp += strlen(http);

						free(header->resource);
						header->resource = malloc(strlen(tmp)+1);
						strncpy(header->resource, tmp, strlen(tmp) + 1);
					} else {

						free(header->resource);
						header->resource = malloc(strlen(buf)+1);
						strncpy(header->resource, buf, strlen(buf) + 1);

					}
/*					printf("GETTOK dir: %s\n", header->resource);*/

					free(buf);
					tmp = NULL;
					break;
				}
			}
			closedir(d);
		}
	}

	return 0;
}
