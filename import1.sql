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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `layout` (`id`, `layouttype`, `value`) VALUES
(1,	'body-backgroundcolor',	'#5cb6fa'),
(2,	'body-font',	'\"Verdana\"'),
(3,	'head-fontcolor',	'#ff8400'),
(4,	'body-fontcolor',	'#ffffff'),
(5,	'body-fontsize',	'10pt'),
(6,	'a-linkcolor',	'#0000ff'),
(7,	'a-visitedcolor',	'#0000ff'),
(8,	'a-hovercolor',	'#000000'),
(9,	'a-activecolor',	'#000000'),
(10,	'menu-color',	'#272647'),
(11,	'menubutton-fontcolor',	'#b3b3b3'),
(12,	'menuhover-backcolor',	'#9999c4'),
(13,	'menuhover-fontcolor',	'#1c1f42'),
(14,	'head-backgroundcolor',	'#ff0000'),
(15,	'h1-color',	'#ff0000'),
(16,	'news-color',	'#ff0000');

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(3) NOT NULL,
  `ip` text NOT NULL,
  `date` text NOT NULL,
  `code` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

INSERT INTO `log` (`id`, `uid`, `ip`, `date`, `code`) VALUES
(1,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:51:55',	302),
(2,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:52:01',	300),
(3,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:53:37',	101),
(4,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:53:50',	100),
(5,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:54:02',	200),
(6,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:54:57',	200),
(7,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:55:04',	200),
(8,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:55:16',	101),
(9,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:55:26',	100),
(10,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:55:33',	200),
(11,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:56:51',	200),
(12,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:57:40',	101),
(13,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:57:59',	100),
(14,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:57:59',	100),
(15,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:58:01',	200),
(16,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:58:23',	100),
(17,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:58:41',	200),
(18,	1,	'127.0.0.1',	'Donderdag 12 April 2012 12:59:27',	200),
(19,	1,	'127.0.0.1',	'Donderdag 12 April 2012 13:06:45',	100),
(20,	1,	'127.0.0.1',	'Donderdag 12 April 2012 13:06:46',	200),
(21,	1,	'127.0.0.1',	'Donderdag 12 April 2012 13:06:47',	200),
(22,	1,	'127.0.0.1',	'Donderdag 12 April 2012 13:25:03',	200),
(23,	1,	'127.0.0.1',	'Donderdag 12 April 2012 13:25:05',	101),
(24,	1,	'127.0.0.1',	'Donderdag 12 April 2012 18:58:28',	100),
(25,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:04:40',	200),
(26,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:05:08',	201),
(27,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:05:17',	500),
(28,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:05:26',	510),
(29,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:05:31',	624),
(30,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:05:53',	500),
(31,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:17:09',	500),
(32,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:17:14',	500),
(33,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:17:38',	500),
(34,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:17:42',	500),
(35,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:18:01',	62),
(36,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:18:29',	624),
(37,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:18:34',	623),
(38,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:18:38',	520),
(39,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:21:10',	605),
(40,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:21:17',	200),
(41,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:21:35',	500),
(42,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:21:40',	625),
(43,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:27:59',	510),
(44,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:28:13',	625),
(45,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:36:27',	200),
(46,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:36:30',	500),
(47,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:40:08',	500),
(48,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:46:37',	500),
(49,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:46:43',	101),
(50,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:50:52',	100),
(51,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:50:55',	200),
(52,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:50:56',	101),
(53,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:55:16',	100),
(54,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:55:21',	200),
(55,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:55:23',	101),
(56,	1,	'127.0.0.1',	'Donderdag 12 April 2012 19:55:54',	100),
(57,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:12:21',	200),
(58,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:12:34',	200),
(59,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:14:57',	200),
(60,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:15:16',	200),
(61,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:15:27',	300),
(62,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:15:53',	400),
(63,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:16:06',	420),
(64,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:17:54',	420),
(65,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:17:57',	410),
(66,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:18:00',	400),
(67,	1,	'127.0.0.1',	'Donderdag 12 April 2012 20:18:07',	101),
(68,	1,	'127.0.0.1',	'Zaterdag 14 April 2012 12:39:57',	100),
(69,	1,	'127.0.0.1',	'Zaterdag 14 April 2012 12:54:31',	200),
(70,	1,	'127.0.0.1',	'Zaterdag 14 April 2012 12:54:39',	101);

DROP TABLE IF EXISTS `nieuws`;
CREATE TABLE `nieuws` (
  `nummer` int(5) NOT NULL,
  `verborgen` tinyint(1) NOT NULL,
  `van` text NOT NULL,
  `datum` text NOT NULL,
  `title` text NOT NULL,
  `tekst` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `nieuws` (`nummer`, `verborgen`, `van`, `datum`, `title`, `tekst`) VALUES
(1,	1,	'Administrator',	'Woensdag 11 April 2012 22:17:30',	'Titel',	'zcv'),
(4,	1,	'Administrator',	'Woensdag 11 April 2012 23:26:09',	'Titel',	'sdf'),
(3,	1,	'Administrator',	'Woensdag 11 April 2012 22:32:04',	'Titel',	'sdfghjk [url=www.google.com/]google.com[/url]'),
(5,	0,	'Administrator',	'Donderdag 12 April 2012 19:21:08',	'Nieuw!',	'[b]Geweldig he[/b], dit nieuwsboxje![br][br]Het heeft alle functies die je maar kan bedenken, zo kunnen we jullie goed op de hoogte houden![br][br]Hier is een link naar onze wiki: [url=https://github.com/Arrjaan/Myst/wiki /]Klik Hier[/url][br][br]Groeten, Admin');

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
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	1,	'',	'',	'',	'',	'43a7484f169188903602bbfe4c2107e5');

DROP TABLE IF EXISTS `webpages`;
CREATE TABLE `webpages` (
  `pageid` int(3) NOT NULL auto_increment,
  `short` varchar(30) NOT NULL,
  `pagename` char(32) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`pageid`),
  UNIQUE KEY `short` (`short`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO `webpages` (`pageid`, `short`, `pagename`, `content`) VALUES
(1,	'index',	'Toespraak koninginnedag.',	'Vandaag vieren we Koninginnedag, net als ieder jaar op 30 april. Toch is het om twee redenen een bijzondere Koninginnedag.\n\nOm te beginnen is het vandaag precies dertig jaar geleden dat Koningin Beatrix werd ingehuldigd. Zij is nu dertig jaar onze Koningin - met volle inzet, zeer betrokken en onvermoeibaar. Ik weet zeker dat ik namens heel Nederland spreek als ik zeg: Majesteit, heel hartelijk dank en onze hartelijke gelukwensen met dit jubileum.\n\nTegelijkertijd is het vandaag natuurlijk ook precies een jaar geleden dat ons land werd opgeschrikt door een onbegrijpelijke daad van een eenling. Wat begon als een prachtig oranje feest in Apeldoorn eindigde abrupt in een drama dat het leven kostte aan acht mensen, waaronder zeven onschuldige omstanders. Gisteren heeft Koningin Beatrix in aanwezigheid van haar familie een herinneringsmonument onthuld ter nagedachtenis aan de slachtoffers. Vandaag vieren zij Koninginnedag in Wemeldinge en Middelburg. Zo dicht liggen momenten van stilte en vreugde soms bij elkaar.\n\nZeeland maakt zich op voor een feestelijke dag, net als de rest van Nederland. En zo hoort het ook. Want Koninginnedag is een van de mooiste tradities die we in Nederland kennen. Het is een feest van iedereen en een dag waarop het oranjegevoel de boventoon voert. Maar het is ook een dag van verbondenheid, met elkaar en met het Huis van Oranje.\n\nIn die geest wens ik iedereen een heel mooie Koninginnedag toe. De Koningin en haar familie in de eerste plaats. En natuurlijk wensen wij professor Van Vollenhoven, die vandaag zijn 71e verjaardag viert, een hele fijne verjaardag toe.\n\nLaat Koninginnedag 2010 in heel Nederland het feest zal zijn zoals we dat kennen en zoals het ook hoort te zijn. Ongedwongen, vrolijk en zonder wanklank. Ik wens u allemaal heel veel plezier toe.\n\n<a href=\"http://www.youtube.com/watch?v=9pBkAn_eLJg&feature=fvst\">Filmpje</a>\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/9pBkAn_eLJg\" frameborder=\"0\" allowfullscreen></iframe>\n\n\n'),
(14,	'hack',	'alert(\'HACK\');',	'Op deze pagina controleer ik of het mogelijk is om te hacken.\n\n- Arjan'),
(6,	'over-ons',	'Over Ons',	'YEAAAAAAAAAAH! HET WERKKET!\n\n<a href=\'http://www.github.com/Arrjaan/Myst\' target=\'_BLANK\'>Myst @ Github</a>\n<a href=\'http://www.github.com/Arrjaan/Myst/wiki\' target=\'_BLANK\'>Bezoek onze Wiki</a>'),
(18,	'daten%3F',	'Daten?',	'Ben jij een knappe jonge dame die graag een leuke, spontane en knappe jongen wil ontmoeten? \nGeef je snel op via: Myst@mystmail.nl!\nWees er snel bij want op = op !\n'),
(16,	'%5C%22het-nieuwe-denken%5C%22',	'\"Het nieuwe denken\"',	'Nieuwe pagina.'),
(17,	'auto%5C%27s',	'Auto\'s',	'Auto\n<img src=\"http://www.autoweek.nl/images/480/8/5b120b704e96b736aad38b65276f8d78.jpg\" height=\"320\" width=\"480\" \">');

-- 2012-04-23 12:34:03
