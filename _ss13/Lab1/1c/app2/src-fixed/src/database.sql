-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 26. Mai 2010 um 16:21
-- Server Version: 5.0.32
-- PHP-Version: 5.2.0-8+etch13
-- 
-- Datenbank: `isec`
-- 

-- --------------------------------------------------------

-- 
-- alte Tabelle `users` entfernen
-- 

DROP TABLE IF EXISTS `users`;

-- 
-- Tabellenstruktur für Tabelle `users`
-- 

CREATE TABLE `users` (
  `username` varchar(64) NOT NULL,
  `logintime` int(11) NOT NULL,
  `sessionid` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `lastnr` int(11) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `users`
-- 

INSERT INTO `users` (`username`, `logintime`, `sessionid`, `password`, `lastnr`) VALUES 
('jim', 1274882479, '517cff80465bcc48d34b847d7dcd9e31', '$1$DChS8QZo$6nuMQRmAe/Rk3NzBFwBNa0', 76),
('joe', 1274882488, '4b2a829f2a74b4f0618fc0aebff21c7d', '$1$uPHenKyE$pFMiHB7vgrFRGzGbgyBYL/', 77),
('alice', 0, '', '$1$y513z9LO$asqECOl2sJqVR.QdlmsPb1', 0),
('bob', 1274883375, '4909f805944eec7d9002b15da7566cdd', '$1$rETTm6k0$H.v9Ti36k4nvuki99BLMk.', 78),
('carol', 0, '', '$1$CIFmETR2$HRihLsONYP5OAeJLCU9Of0', 0),
('dave', 0, '', '$1$7TE3gvJ.$mqMphbCGOs375mslbhx8C/', 0),
('tim', 0, '', '$1$UBeMIPuW$QIljwMUZt84DaTrV16M2j.', 0),
('tom', 0, '', '$1$.81UfKTA$mU.SfdKDgcRvUFmT7t4lw0', 0);
