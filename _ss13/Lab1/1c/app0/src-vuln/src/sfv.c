#include<stdio.h>
#include<string.h>
#include<stdlib.h>
#include<unistd.h>
#include<ctype.h>

int checkLogin();
void startCalculator();
void checkOpt(int argc, char ** argv);

int ta = 1;

int main (int argc, char ** argv) {
  checkOpt(argc, argv);

  if (checkLogin() == 1) {
    startCalculator();
  }

  return 0;
}


int checkLogin() {
  char input[20];
  char *s1 = "haha\n";
  char *s2 = "sag ich nicht\n";
  char *s3 = "test\n";
  char *pwd = "secret\n";

  printf("%x\n", &pwd);

  printf("Passwort eingeben: \n");
  fgets(input, 20, stdin);
 
  if (strcmp(pwd, input) == 0) {
    return 1;
  } else {
      printf(input);
    
    printf("\n");
    return 0;
  }
}

void startCalculator() {
  int stop = 0;
  int x,y;
  char a[30], b[30], op[10];

  do {
    printf("Zahl 1: ");
    fgets(a, 30, stdin);
    
    printf("Operand (+,-,/,*): ");
    fgets(op, 10, stdin);

    printf("Zahl 2: ");
    fgets(b, 30, stdin);

    printf("Ergebnis fuer Rechnung: \n");
 
      printf(a);
      printf(op);
      printf(b);
      printf("=====\n");

    x = atoi(a);
    y = atoi(b);
    if (op[0] == '+') {
      printf("%d", x+y);
    } else if (op[0] == '-') {
      printf("%d", x-y);
    } else if (op[0] == '*') {
      printf("%d", x*y);
    } else if (op[0] == '/' && y != 0) {
      printf("%d", x/y);
    }

    printf("\nweiter? (j)");
    fgets(op, 10, stdin);
    if(op[0] != 'j') {
      stop = 1; 
    }
  } while (stop == 0);
}

void checkOpt(int argc, char **argv) {
  int c;

  while((c = getopt(argc, argv, "a")) != -1) {
    if (c == 'a') {
      ta = 0;
    }
  }

}
