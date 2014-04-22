CREATE TABLE user (
id INTEGER DEFAULT '1' PRIMARY KEY AUTOINCREMENT NOT NULL,
username VARCHAR(32)  NOT NULL,
password VARCHAR(32)  NOT NULL
);

CREATE TABLE whatevernote (
whatevernote_id INTEGER DEFAULT '1' NOT NULL PRIMARY KEY AUTOINCREMENT,
username INTEGER NOT NULL,
title VARCHAR(32)  NOT NULL,
note VARCHAR(255) NOT NULL
);

INSERT INTO user (username,password) VALUES('Don Michael Corleone','TeepioVu');
INSERT INTO user (username,password) VALUES('Kay Corleone','cu3Yahv6');
INSERT INTO user (username,password) VALUES('Don Vito Corleone','OongoGei');
INSERT INTO user (username,password) VALUES('Fredo Corleone','ahHeuGhe');
INSERT INTO user (username,password) VALUES('Tom Hagen','Mah5ogho');
INSERT INTO user (username,password) VALUES('Hyman Roth','Gei3vaa1');
INSERT INTO user (username,password) VALUES('Frankie Pentangeli','heKiPh1X');
INSERT INTO user (username,password) VALUES('Connie Corleone Rizzi','Rat8fiew');
INSERT INTO user (username,password) VALUES('Santino Corleone','Loub7ohx');
INSERT INTO user (username,password) VALUES('Carlo Rizzi','AkohPh5L');
INSERT INTO user (username,password) VALUES('Albert Neri','Loub7ohx');
INSERT INTO user (username,password) VALUES('Deanna Corleone','Aing9Goh');
INSERT INTO user (username,password) VALUES('Johnny Ola','eeng0Vae');


INSERT INTO whatevernote (username,title,note) VALUES(1,'success','developing the greatest software in the world!!!!!111!!!!');
INSERT INTO whatevernote (username,title,note) VALUES(1,'windows','sucks');
INSERT INTO whatevernote (username,title,note) VALUES(2,'database','Todo: secure databased!!!!');


