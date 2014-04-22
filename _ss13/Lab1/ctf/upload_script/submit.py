#!/usr/bin/env python
import sys
import socket
import sys

def sreadline(sock):
        line = sock.makefile().readline()
        dbgOutput("recv: " + line)
        return line

def swriteline(sock, line):
        dbgOutput("send: " + line)
        sock.send(line + "\n")

def dbgOutput(msg):
        print("%s\n" % msg)

if __name__ == '__main__':

	sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	sock.connect(("192.168.40.200", 80))

	#flag = "130620131510524BZ4YY0S23WO6P1ZFE"
	flag = sys.argv[1]

	print(sys.argv[1])

        swriteline(sock, "GET /SubmitFlagServlet?teamInput=117&flagInput=" + flag + " HTTP/1.1\r\nHost: 192.168.40.200\n")

	print sock.recv(4000)
	print sock.recv(4000)
	print sock.recv(4000)
	print sock.recv(4000)


	sock.close()
