CFLAGS = -mpreferred-stack-boundary=2 -Wno-format

all: sfv

sfv: sfv.c
	gcc $(CFLAGS) sfv.c -o sfv

clean: 
	rm -f *.o sfv
