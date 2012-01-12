<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Myst</title>
		<link href="http://217.121.7.218/Myst/html/all_browsers.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script type="text/javascript" src="http://217.121.7.218/Myst/html/ajax.js"></script>
		<script type="text/javascript" src="http://217.121.7.218/Myst/html/jquery.js"></script>
		<link rel="shortcut icon" href="http://217.121.7.218/Myst/html/img/favicon.ico" />
	</head>

	<body>
		<div id="head">Wielrennervereniging HLB
			<div id="head_img"></div>
		</div>
		
		<div id="menu">
			<h1>Menu</h1>
			
			<ul class="menu">
			<li><a href="javascript:void(0)" onclick="load('home')">Home</a></li>
			<li><a href="javascript:void(0)" onclick="load('nieuws')">Nieuws</a></li>
			<li><a href="javascript:void(0)" onclick="load('agenda')">Agenda</a></li>
			<li><a href="javascript:void(0)" onclick="load('contact')">Contact</a></li>
			</ul>
			<br />
			<ul class="menu">
			<li><a href="javascript:void(0)" onclick="load('sport')">Over Wielrennen</a></li>
			</ul>
			
		</div>
		
		<div id="content">
			
			<?php
						
			//Doorverwijzing bij http-fout.
			if ( isset($_GET['404']) ) echo '<h2>Pagina kon niet gevonden worden. (404)</h2><br />';
			if ( isset($_GET['401']) ) echo '<h2>Dit is een beveiligde pagina, wachtwoord nodig. (401)</h2><br />';
			if ( isset($_GET['403']) ) echo '<h2>Geen toegang. (403)</h2><br />';
			?>
			
			<?php
			//Content printen.
				echo $content;
			?>	
										
		</div>
		
		<div id="footer">			
			<div id="footer_right">
			<a href="http://validator.w3.org/check?uri=referer">
			<img
			src="http://www.w3.org/Icons/valid-xhtml10-blue"
			alt="Valid XHTML 1.0 Transitional" border="0" /></a>

			&nbsp;

			<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img style="border:0;width:88px;height:31px"
			src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
			alt="Valide CSS!" />
			</a>
			
			</div>
		</div>
	</body>
</html>