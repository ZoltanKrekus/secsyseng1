#include <fcntl.h>
#include <string.h>
#include <stdio.h>
#include <unistd.h>

#include "reqheader.h"
#include "resfiles.h"
#include "common.h"


#define BUFMAX 256
int getResource(int sockfd, int resource, struct ReqHeader *header) {
	int i;
	char c[BUFMAX];

	while ((i = read(resource, &c, BUFMAX))) {
		if (i < 0) {
			printerr("Reading file.");
			break;
		}
		if (write(sockfd, &c, i) < 1) {
			printerr("Writing file to socket.");
		}
	}

	return 0;
}

int checkResource(struct ReqHeader *header) {
	if (header != NULL && header->resource != NULL) {
		strcat(http, header->resource);
		return open(http, O_RDONLY);
	} else {
		return -1;
	}

}
