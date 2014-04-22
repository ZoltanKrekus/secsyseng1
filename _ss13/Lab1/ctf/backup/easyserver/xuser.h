#ifndef XUSER_H
#define XUSER_H

#include "reqheader.h"

struct XUser {
	char *name;
	char *pwd;
	char *token;
};

void initUser(struct XUser *);
void freeUser(struct XUser *);
void printUser(struct XUser *);
int checkPwd(char *, struct ReqHeader *);
int regUser(char *, char *, char *, char *, char *);
int genList(char *, char *);
int getTok(char *, struct ReqHeader *);

#endif
