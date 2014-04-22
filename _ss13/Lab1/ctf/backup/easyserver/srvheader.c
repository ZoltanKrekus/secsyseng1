#include <stdio.h>
#include <string.h>

#include "srvheader.h"
#include "common.h"

int getServerHeader(int sockfd, struct ReqHeader *header) {
	char buf[256];

	sprintf(buf, "HTTP/1.0 %d OK\r\n", header->status);

	writeline(sockfd, buf, strlen(buf));
	writeline(sockfd, "Server: ensehub\r\n", 17);
	writeline(sockfd, "Content-Type: text/html\r\n", 25);
	writeline(sockfd, "\r\n", 2);

	return 0;
}
