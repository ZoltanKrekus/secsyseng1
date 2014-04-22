#!/usr/bin/python

import sys
import time
import signal
import socket
import threading
import Queue
import SocketServer
import uuid
import hashlib
import random
import logging

HOST = ''
PORT = 9999
DQUEUE = Queue.Queue()
SESSIONS = {}
USERS = {}
SECRETS = {}
SERVER = None
CHATTER = None
SERVERTHREAD = None
QUEUEGETTIMEOUT = 4
LOGPATH="/var/log/colaboservice/colabo.log"

class ThreadedServer(SocketServer.ThreadingMixIn, SocketServer.TCPServer):
    daemon_threads = True
    allow_reuse_address = True

    def __init__(self, server_address, RequesthandlerClass):
        print "starting socket server..."
        SocketServer.TCPServer.__init__(self, server_address, RequesthandlerClass)
        
        print "socket server running"
        self.dist = Distributor()
        self.dist.start()
        self.socket.settimeout(0.5)
        self.serving = True


class ClientWriter(threading.Thread):


    def __init__(self,queue,fileToWrite,sessionID):
        threading.Thread.__init__(self)
        self.stop_event = threading.Event()
        self.queue = queue
        self.fileToWrite = fileToWrite
        self.id = sessionID

    def run(self):
        while not self.stop_event.isSet():
            try:
                #message = self.queue.get(true,QUEUEGETTIMEOUT )
                message = self.queue.get()
            except:
                self.stop()
                break;
            try:
                self.fileToWrite.write(message)
            except:
                logging.error("could not write message on session {0}, allready closed".format(self.id))
                self.stop()
                break;
            del message
        self.queue = Queue.Queue()
        with self.queue.mutex:
            self.queue.queue.clear()
        self.queue = None
        del SESSIONS[self.id]


    def stop(self):
        logging.debug("stopping Clientwriter Thread {0}".format(self.id))
        self.stop_event.set()

class ClientHandler(SocketServer.StreamRequestHandler):

    id = ''

    def handle(self):

        logging.debug("connection opened from {0}".format(self.client_address[0]))
        while True:

            self.data = self.rfile.readline().strip()
            if not self.data:
                break

            command,sep,args = self.data.partition(' ')

            if self.id == '':
                if command == 'register':

                    argslist = args.split()
                    if len(argslist) != 2:
                        self.wfile.write("usage:register <username> <password>\n")
                    else:

                        username = argslist[0]
                        password = argslist[1]

                        succ = self.registerUser(username,password)
                        if succ:
                            self.wfile.write("user " + username + " successfully registered\n")
                            logging.info("user {0} successfully registered".format(username))
                        else:
                            self.wfile.write("user " + username + " allready registered on this server\n")
                            logging.info("user {0} allready registered".format(username))

                elif command == 'login':
                    argslist = args.split()

                    if len(argslist) in [2,3]:
                        username = argslist[0]
                        password = argslist[1]

                        self.username = username
                        succ = self.loginUser(username,password,argslist[2:3])
                        
                        if succ:
                            if self.id == '':
                                self.id = uuid.uuid4()
                            self.initSession()
                            SESSIONS[self.id]=self.worker   #ref the worker
                            self.wfile.write("Login successful, your session id is " + str(self.id) + "\n")
                        else:
                            self.wfile.write("Login failed\n")

                    else:
                        self.wfile.write("usage:login <username> <password> [<session id>]\n")



                else:
                    self.wfile.write("Not allowed\n");
            else:

                if command == 'message':
                    DQUEUE.put(ClientMessage(self.id,self.username,args))
                elif command == 'store':
                    self.storeSecret(self.username,args)
                    self.wfile.write("secret stored\n")
                elif command == 'retr':
                    retrSecret = self.retrieveSecret(self.username)
                    self.wfile.write(retrSecret)
                    self.wfile.write("\n")
                elif command == 'users':
                    self.wfile.write("registered user on this server:\n")
                    for u in USERS:
                        self.wfile.write(u+" ")
                        self.wfile.write("\n")
                elif command == 'stats':
                    self.wfile.write("Server Statistics:\n")
                    actUsers=len(USERS)
                    actSessions=len(SESSIONS)
                    actSecrets=len(SECRETS.keys())
                    self.wfile.write("registered Users: {0}\tactive Sessions: {1}\tstored Secrets: {2}\n".format(actUsers,actSessions,actSecrets))
                elif command == 'logout':
                    self.wfile.write("loggin out")
                    break
                else:
                    self.wfile.write("Not allowed\n");
        if hasattr(self,'worker'):
            self.worker.stop()
        #del SESSIONS[self.id]
        self.closeSession()

    def initSession(self):
        self.queue = Queue.Queue()
        self.worker = ClientWriter(self.queue,self.wfile,self.id)
        self.worker.start()

    def closeSession(self):
        try:
            #del SESSIONS[self.id] #do this in worker
            self.queue = Queue.Queue()
            with self.queue.mutex:
                self.queue.queue.clear()
            self.queue = None
            self.worker = None
        except:
            logging.error("could not remove session " + str(self.id))

    def registerUser(self,username,password):
        if username in USERS:
            return False
        USERS[username]=hashlib.sha256(password).hexdigest()
        return True

    def loginUser(self,username,password,session):
        if not session == []:
            try:
                self.id = uuid.UUID(str(session[0]))
        	logging.info("sessionID: ".format(session[0]))
	    except:
                self.id = uuid.uuid4()

        if username not in USERS:
            return False
        if USERS[username] == hashlib.sha256(password).hexdigest():
            return True


    def storeSecret(self,username,secret):
        logging.debug("user {0} stored a secret".format(username))
        SECRETS[username]=secret

    def retrieveSecret(self,username):
        if username in SECRETS.keys():
            return SECRETS[username]
        else:
            return 'no secret stored'

class Distributor(threading.Thread):

    def __init__(self):
        threading.Thread.__init__(self)
        self.stop_event = threading.Event()

    def stop(self):
        #debug
        logging.info("stopping Distributor")
        self.stop_event.set()

    def run(self):
        logging.info("Distributor started")
        while not self.stop_event.isSet():
            
            try:
                #message = DQUEUE.get(true,QUEUEGETTIMEOUT) #block 2 seconds
                message = DQUEUE.get() #block
            except:
                continue                     #continue ( needed for stop check ) 
            #debug
            #logging.info(message)

            tmpSessions = dict(SESSIONS)
            for sessionID in tmpSessions:
                s = tmpSessions[sessionID]

                if not sessionID == message.sessionID:  #dont send the message to the origin
                    #debug
                    #print "put message " + str(message) + " in queue for " + str(sessionID)
                    s.queue.put(message.getChatText())
            #except RuntimeError as e:
            #    print "Error reading sessions {0}".format(e)
            #    continue
            del tmpSessions


class Chatter(threading.Thread):

    bn = ["overdrive","colabo","root","sevG.82","bnotobnoob","punciExplorer69","yourMama","badCoder","haxxor","eliteNoob","idiotyAtitsBest","d1g1talGangsta","exploitQueen","FBIundercover","AnonTrooper32","M&M","iLikeToTeamkill","quakeGuru"]
    messages = ["lol","c&p the flags here ...","my password is sexyAndromeda, %s can u fix my sshd installation?","%s you such an idiot", "oh, i think i found a bufferoverflow","try to localhost/rootbackdoor.php, this will help","rm -f *","can u send me the shellcode plz?", "%s ask your mum about me", "hello %s, whats up?", "%s wanna party tonight?","is this a bug?","no its not, rtfm", "%s you are really a noob, this python service is the weakest in this contest", "CTF anyone?", "%s, are you on our team?", "wow, i just rootet this noobs, check this out:\nnc gameserver/flags.php?u=root&pw=Null"]

    def __init__(self):
        logging.info("Starting Chatter Tread")
        threading.Thread.__init__(self)
        self.stop_event = threading.Event()

    def run(self):
        _="_"
        while not self.stop_event.isSet():
            u="USERS"
            time.sleep(random.randint(2,10))  #make this random
            if len(USERS) > 0:
                n= self.bn[random.randint(0,len(self.bn)-1)]
                m = self.messages[random.randint(0,len(self.messages)-1)]
                m = m.replace("%s",USERS.keys()[random.randint(0,len(USERS)-1)])
                DQUEUE.put(ClientMessage(uuid.uuid4(),n,m))

    def stop(self):
        logging.info("stopping Chatter Thread")
        self.stop_event.set()

class ClientMessage(object):

    def __init__(self,sessionID,username,message):
        self.sessionID=sessionID
        self.message = message
        self.username = username

    def getChatText(self):
        return "%s wrote: %s\n" % (self.username,self.message)

    def __repr__(self):
        return "<Message from Clientsession " + str(self.sessionID) + ": " + self.message+">"


def signal_handler(signal, frame):
    logging.info("shutting down")
    print "shutting down"
    try:
        CHATTER.stop()
        SERVER.dist.stop()
        SERVER.shutdown()
        SERVER.server_close()
        print "server is shutdown"
    except Exception as e:
        logging.error(e)
    logging.shutdown()
    sys.exit(0)


if __name__ == "__main__":


    LOGGER=logging.getLogger()
    hdlr = logging.FileHandler(LOGPATH)
    formatter = logging.Formatter('%(asctime)s %(levelname)s %(message)s')
    hdlr.setFormatter(formatter)
    LOGGER.addHandler(hdlr) 
    LOGGER.setLevel(logging.INFO)
    #LOGGER.setLevel(logging.DEBUG)
    LOGGER.info("starting ColaboService ...")

    signal.signal(signal.SIGINT, signal_handler)
    
    try:
        print "going to start threadserver"
        server = ThreadedServer((HOST, PORT), ClientHandler)
        print "threadserver running"
    except Exception as e:
        print e
        logging.error(e)
        logging.shutdown()
        sys.exit(-1)
    SERVER = server

    SERVERTHREAD = threading.Thread(target=server.serve_forever)
    SERVERTHREAD.daemon = True
    
    try:
        SERVERTHREAD.start()
    except Exception as e:
        logging.error(e)

    CHATTER = Chatter()
    CHATTER.start()

    signal.pause()


    del SERVER
    CHATTERTHREAD.join()
    SERVERTHREAD.join()
