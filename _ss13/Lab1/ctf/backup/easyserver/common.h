#ifndef COMMON_H
#define COMMON_H

#ifdef DEBUG
#define DEBUG_PRINT(x) printf x
#else
#define DEBUG_PRINT(x) do {} while (0)
#endif

extern char http[100];
extern char userdir[100];
extern char listname[100];

int strUpper(char *);
int trim(char *);
int readline(int, void *, int);
int writeline(int, void *, int);
void printerr(char *);

#endif
