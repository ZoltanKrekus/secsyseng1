#ifndef REQHEADER_H
#define REQHEADER_H

#define MAX_REQ 1024

enum Req_Method {
	GET,
	HEAD,
	UNSUPPORTED
};

static char *stringFromReqMethod(enum Req_Method rm) {
	static char *strings[] = {
		"GET",
		"HEAD",
		"UNSUPPORTED"
	};
	return strings[rm];
}

enum Req_Type {
	SIMPLE,
	FULL
};

static char *stringFromReqType(enum Req_Method rt) {
	static char *strings[] = {
		"SIMPLE",
		"FULL"
	};
	return strings[rt];
}

struct ReqHeader {
	enum Req_Method method;
	enum Req_Type type;
	char *referer;  
	char *useragent;
	char *resource; 
	int status;
	char *xreg;     /* Register flag; "true" -> add new user */
	char *xlist;    /* "true" -> list all users */
	char *xuser;    /* (new) user name with password */
	char *xauth;    /* if user & pwd correct -> "true" */
	char *xtok;		/* the token associated with the user */
	char *xpwd;		/* the user's password */
};

int parseHeader(char *, struct ReqHeader *);
void initReqHeader(struct ReqHeader *);
void freeReqHeader(struct ReqHeader *);
void printHeader(struct ReqHeader *);

#endif
