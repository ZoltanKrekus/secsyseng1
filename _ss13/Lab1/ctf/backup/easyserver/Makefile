all: server

server: server.o common.o reqheader.o resfiles.o srvheader.o xuser.o
	gcc -o server server.o reqheader.o common.o resfiles.o srvheader.o xuser.o

server.o: server.c common.h reqheader.h resfiles.h
	gcc -o server.o server.c -c -ansi -pedantic

common.o: common.c common.h
	gcc -o common.o common.c -c -ansi -pedantic

reqheader.o: reqheader.c reqheader.h common.h xuser.h
	gcc -o reqheader.o reqheader.c -c -ansi -pedantic

srvheader.o: srvheader.c srvheader.h common.h resfiles.h
	gcc -o srvheader.o srvheader.c -c -ansi -pedantic

resfiles.o: resfiles.c resfiles.h reqheader.h common.h
	gcc -o resfiles.o resfiles.c -c -ansi -pedantic

xuser.o: xuser.c xuser.h reqheader.h resfiles.h common.h
	gcc -o xuser.o xuser.c -c -ansi -pedantic

clean-o:
	rm -f *.o

clean:
	rm -f *.o
	rm -f server

.PHONY: all clean
