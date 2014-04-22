#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <errno.h>

#include <sys/socket.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <signal.h>

#include "common.h"
#include "reqheader.h"
#include "srvheader.h"
#include "resfiles.h"

#define PORT 7331

char http[100] = "./http";
char userdir[100] = "/users/";
char listname[100] = "/users/userlist";

int handleRequest(int sockfd) {
	struct ReqHeader header;
	int resource = 0;

	initReqHeader(&header);

	if (getRequest(sockfd, &header) < 0) {
		return -1;
	}
	/* TODO DEBUG printHeader(&header);*/

	if (header.status == 200) {
		if ((resource = checkResource(&header)) < 0) {
			if (errno == EACCES) {
				header.status = 401;
			} else {
				header.status = 404;
			}
		}
	}

	if (header.type == FULL) {
		getServerHeader(sockfd, &header);
	}

	if (header.status == 200) {
		if (getResource(sockfd, resource, &header)) {
			printerr("getResource failed.");
		}
	}

	if (resource > 0) {
		if (close(resource) < 0) {
			printerr("Closing resource.");
		}
	}

	freeReqHeader(&header);

	return 0;
}

int main(void) {
	int sockfd, new_sockfd;
	struct sockaddr_in host_addr, client_addr;
	socklen_t sin_size;
	int recv_length = 1, yes = 1;
	char buffer[1024];
	pid_t pid;

	/* ignore sigchld, don't produce zombies */
	signal(SIGCHLD, SIG_IGN);

	if ((sockfd = socket(PF_INET, SOCK_STREAM, 0)) == -1) {
		printerr("socket");
	}

	if (setsockopt(sockfd, SOL_SOCKET, SO_REUSEADDR, &yes, sizeof(int)) == -1) {
		printerr("setsockopt");
	}

	memset(&host_addr, 0, sizeof(host_addr));
	host_addr.sin_family = AF_INET;
	host_addr.sin_port = htons(PORT);
	host_addr.sin_addr.s_addr = htons(INADDR_ANY);

	if (bind(sockfd, (struct sockaddr *)&host_addr, sizeof(struct sockaddr)) == -1) {
		 printerr("bind");
	}

	if (listen(sockfd, 1024) == -1) {
		printerr("listen");
	}

	while (1) {
		sin_size = sizeof(struct sockaddr_in);
		new_sockfd = accept(sockfd, NULL, NULL);

		if (new_sockfd > 0) {
			if ((pid = fork()) == 0) {
#if 0
				if (close(sockfd) < 0) {
					printerr("Closing sockfd in child");
				}
#endif

				handleRequest(new_sockfd);

				if (close(new_sockfd) < 0) {
					printerr("Closing new_sockfd in child");
				}
				exit(EXIT_SUCCESS);
			}

			if (close(new_sockfd) < 0) {
				printerr("Closing new_sockfd in parent");
			}
		}
	}

	return EXIT_FAILURE;
}
