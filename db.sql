-- Adminer 3.2.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout` (
  `id` int(11) NOT NULL auto_increment,
  `layouttype` varchar(20) NOT NULL,
  `value` varchar(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `layouttype` (`layouttype`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `layout` (`id`, `layouttype`, `value`) VALUES
(1,	'body-backgroundcolor',	'#5cb6fa'),
(2,	'body-font',	'\"Calibri\"'),
(3,	'head-fontcolor',	'#ff8400'),
(4,	'body-fontcolor',	'#ffffff'),
(5,	'body-fontsize',	'11pt'),
(6,	'a-linkcolor',	'#0000ff'),
(7,	'a-visitedcolor',	'#0000ff'),
(8,	'a-hovercolor',	'#000000'),
(9,	'a-activecolor',	'#000000'),
(10,	'menu-color',	'#272647'),
(11,	'menubutton-fontcolor',	'#b3b3b3'),
(12,	'menuhover-backcolor',	'#9999c4'),
(13,	'menuhover-fontcolor',	'#1c1f42'),
(14,	'head-backgroundcolor',	'#ff0000'),
(15,	'h1-color',	'#ff0000');

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(3) NOT NULL,
  `ip` text NOT NULL,
  `date` text NOT NULL,
  `code` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `siteinfo`;
CREATE TABLE `siteinfo` (
  `title` varchar(20) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `siteinfo` (`title`) VALUES
('Titel');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(3) NOT NULL auto_increment,
  `username` char(15) NOT NULL,
  `password` char(32) NOT NULL,
  `rights` int(1) NOT NULL,
  `name` char(32) NOT NULL,
  `surname` char(32) NOT NULL,
  `email` char(32) NOT NULL,
  `tussenvgsl` char(10) NOT NULL,
  `hash` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `rights`, `name`, `surname`, `email`, `tussenvgsl`, `hash`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	1,	'',	'',	'',	'',	NULL);

DROP TABLE IF EXISTS `webpages`;
CREATE TABLE `webpages` (
  `pageid` int(3) NOT NULL auto_increment,
  `short` varchar(30) NOT NULL,
  `pagename` char(32) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`pageid`),
  UNIQUE KEY `short` (`short`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `webpages` (`pageid`, `short`, `pagename`, `content`) VALUES
(1,	'index',	'Toespraak koninginnedag',	'Vandaag vieren we Koninginnedag, net als ieder jaar op 30 april. Toch is het om twee redenen een bijzondere Koninginnedag.\n\nOm te beginnen is het vandaag precies dertig jaar geleden dat Koningin Beatrix werd ingehuldigd. Zij is nu dertig jaar onze Koningin - met volle inzet, zeer betrokken en onvermoeibaar. Ik weet zeker dat ik namens heel Nederland spreek als ik zeg: Majesteit, heel hartelijk dank en onze hartelijke gelukwensen met dit jubileum.\n\nTegelijkertijd is het vandaag natuurlijk ook precies een jaar geleden dat ons land werd opgeschrikt door een onbegrijpelijke daad van een eenling. Wat begon als een prachtig oranje feest in Apeldoorn eindigde abrupt in een drama dat het leven kostte aan acht mensen, waaronder zeven onschuldige omstanders. Gisteren heeft Koningin Beatrix in aanwezigheid van haar familie een herinneringsmonument onthuld ter nagedachtenis aan de slachtoffers. Vandaag vieren zij Koninginnedag in Wemeldinge en Middelburg. Zo dicht liggen momenten van stilte en vreugde soms bij elkaar.\n\nZeeland maakt zich op voor een feestelijke dag, net als de rest van Nederland. En zo hoort het ook. Want Koninginnedag is een van de mooiste tradities die we in Nederland kennen. Het is een feest van iedereen en een dag waarop het oranjegevoel de boventoon voert. Maar het is ook een dag van verbondenheid, met elkaar en met het Huis van Oranje.\n\nIn die geest wens ik iedereen een heel mooie Koninginnedag toe. De Koningin en haar familie in de eerste plaats. En natuurlijk wensen wij professor Van Vollenhoven, die vandaag zijn 71e verjaardag viert, een hele fijne verjaardag toe.\n\nLaat Koninginnedag 2010 in heel Nederland het feest zal zijn zoals we dat kennen en zoals het ook hoort te zijn. Ongedwongen, vrolijk en zonder wanklank. Ik wens u allemaal heel veel plezier toe.\n\n<a href=\"http://www.youtube.com/watch?v=9pBkAn_eLJg&feature=fvst\">Filmpje</a>\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/9pBkAn_eLJg\" frameborder=\"0\" allowfullscreen></iframe>\n'),
(14,	'hack',	'alert(\'HACK\');',	'Op deze pagina controleer ik of het mogelijk is om te hacken.\n\n- Arjan'),
(6,	'over-ons',	'Over Ons',	'YEAAAAAAAAAAH! HET WERKKET!\n\n<a href=\'http://www.github.com/Arrjaan/Myst\' target=\'_BLANK\'>Myst @ Github</a>\n<a href=\'http://www.github.com/Arrjaan/Myst/wiki\' target=\'_BLANK\'>Bezoek onze Wiki</a>'),
(12,	'%26%40%24%24%25%23%40%40%24%25',	'&@$$%#@@$%#@$%#@$#@^&!!%!$#%!$#%',	'Deze pagina laat zien dat zelfs vreemde tekens kunnen worden gebruikt in de paginatitel.\n\n:)'),
(15,	'pagina',	'PAGINA',	'hahahaahahahahaaahaha!\n\nik bedoel\n\nmiauw..'),
(16,	'%5C%22het-nieuwe-denken%5C%22',	'\"Het nieuwe denken\"',	'Nieuwe pagina.'),
(17,	'auto%5C%27s',	'Auto\'s',	'Nieuwe pagina.');

-- 2012-04-07 06:41:05
