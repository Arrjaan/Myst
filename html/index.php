<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title><?php echo $config['title']; ?></title>
		<link href="html/all_browsers.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		
		<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
	
		<script type="text/javascript" src="html/colorpicker/js/colorpicker.js"></script>
		<script type="text/javascript" src="html/colorpicker/js/eye.js"></script>
		<script type="text/javascript" src="html/colorpicker/js/utils.js"></script>
		<script type="text/javascript" src="html/colorpicker/js/layout.js?ver=1.0.2"></script>
		<link rel="stylesheet" href="html/colorpicker/css/colorpicker.css" type="text/css" />
		
		<script type="text/javascript" src="html/ajax.js"></script>
		<script type="text/javascript" src="html/tinymce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "advanced",
				plugins : "table,inlinepopups",

				// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,table,removeformat,code",
				theme_advanced_buttons2 : "",
				theme_advanced_buttons3 : "",
				theme_advanced_buttons4 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,

				// Example content CSS (should be your site CSS)
				content_css : "/html/all_browsers.css",

				// Style formats
				style_formats : [
						{title : 'Bold text', inline : 'b'},
						{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
						{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
						{title : 'Example 1', inline : 'span', classes : 'example1'},
						{title : 'Example 2', inline : 'span', classes : 'example2'},
						{title : 'Table styles'},
						{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
				],

				formats : {
						alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
						aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
						alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
						alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
						bold : {inline : 'span', 'classes' : 'bold'},
						italic : {inline : 'span', 'classes' : 'italic'},
						underline : {inline : 'span', 'classes' : 'underline', exact : true},
						strikethrough : {inline : 'del'},
						customformat : {inline : 'span', styles : {color : '#00ff00', fontSize : '20px'}, attributes : {title : 'My custom format'}}
				}
		});
		</script>

		<link rel="shortcut icon" href="html/img/favicon.ico" />
		<?php
		print ('<style type ="text/css">');

		$bodybackgroundcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'body-backgroundcolor'");
		$bodybackgroundcolor = $bodybackgroundcolor->fetch_assoc();
		$bodybackgroundcolor = $bodybackgroundcolor['value'];

		$bodyfont = $db->query("SELECT value FROM layout WHERE layouttype = 'body-font'");
		$bodyfont = $bodyfont->fetch_assoc();
		$bodyfont = $bodyfont['value'];

		$bodyfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'body-fontcolor'");
		$bodyfontcolor = $bodyfontcolor->fetch_assoc();
		$bodyfontcolor = $bodyfontcolor['value'];

		$bodyfontsize = $db->query("SELECT value FROM layout WHERE layouttype = 'body-fontsize'");
		$bodyfontsize = $bodyfontsize->fetch_assoc();
		$bodyfontsize = $bodyfontsize['value'];

		$headfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'head-fontcolor'");
		$headfontcolor = $headfontcolor->fetch_assoc();
		$headfontcolor = $headfontcolor['value'];

		$headbackgroundcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'head-backgroundcolor'");
		$headbackgroundcolor = $headbackgroundcolor->fetch_assoc();
		$headbackgroundcolor = $headbackgroundcolor['value'];

		$alinkcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-linkcolor'");
		$alinkcolor = $alinkcolor->fetch_assoc();
		$alinkcolor = $alinkcolor['value'];

		$avisitedcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-visitedcolor'");
		$avisitedcolor = $avisitedcolor->fetch_assoc();
		$avisitedcolor = $avisitedcolor['value'];

		$ahovercolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-hovercolor'");
		$ahovercolor = $ahovercolor->fetch_assoc();
		$ahovercolor = $ahovercolor['value'];

		$aactivecolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-activecolor'");
		$aactivecolor = $aactivecolor->fetch_assoc();
		$aactivecolor = $aactivecolor['value'];

		$menubuttonfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menubutton-fontcolor'");
		$menubuttonfontcolor = $menubuttonfontcolor->fetch_assoc();
		$menubuttonfontcolor = $menubuttonfontcolor['value'];

		$menuhoverbackcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menuhover-backcolor'");
		$menuhoverbackcolor = $menuhoverbackcolor->fetch_assoc();
		$menuhoverbackcolor = $menuhoverbackcolor['value'];

		$menuhoverfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menuhover-fontcolor'");
		$menuhoverfontcolor = $menuhoverfontcolor->fetch_assoc();
		$menuhoverfontcolor = $menuhoverfontcolor['value'];

		$h1color = $db->query("SELECT value FROM layout WHERE layouttype = 'h1-color'");
		$h1color = $h1color->fetch_assoc();
		$h1color = $h1color['value'];
		
		$newscolor = $db->query("SELECT value FROM layout WHERE layouttype = 'news-color'");
		$newscolor = $newscolor->fetch_assoc();
		$newscolor = $newscolor['value'];

		print ("\r\n 
				a:link{color:".$alinkcolor.";}\r\n
				a:visited{color:".$avisitedcolor.";}\r\n
				a:hover{color:".$ahovercolor.";}\r\n
				a:active{color:".$aactivecolor.";}\r\n");
		print ("body {\r\nfont-family: ".$bodyfont.", Veranda, Ariel, serif;\r\n
		background-color:".$bodybackgroundcolor.";\r\n 
		color: ".$bodyfontcolor.";\r\n 
		font-size: ".$bodyfontsize.";\r\n}\r\n\r\n");
		print ("#head {\r\ncolor: ".$headfontcolor.";\r\n
				background-color: ".$headbackgroundcolor.";\r\n}");
		print ("ul#menu {background-color:".$menucolor.";}\r\n");
		print ("ul#menu li a {color:".$menubuttonfontcolor.";}\r\n");
		print ("ul#menu li a:hover \r\n {
		background:".$menuhoverbackcolor.";\r\n
		color:".$menuhoverfontcolor.";\r\n}\r\n");
		print("H1 {color: ".$h1color.";}");
		print("#nieuws{background-color: ".$newscolor.";}");
		print ('</style>');
		echo $db->error;
		?>
	</head>

	<body>
	<?php if ( check_login($_SESSION['hash'],$_SESSION['id'],$db) ) echo '<script>$(document).ready(function() {autoLogin();});</script>'; ?>
	<div id="wrap">
		<div id="head"><?php echo $config['title']; ?></div>
			
		<ul id="menu">
			<li><a href="?p=index">Home</a></li>
			<?php 
				$q = $db->query("select * from `webpages` where `pageid` != '1'");

				while ( $r = $q->fetch_assoc() ) {
					echo '<li><a href="?p='.urlencode($r['short']).'">'.$r['pagename'].'</a></li>'."\r\n";
				}
			?>
			<li><a href="javascript:void(0)" class="adminlogin" rel="#prompt">Admin</a></li>
		</ul>
		<div id="nieuws">
		EFSFSFSEwserseserser
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
				if ( @$_SESSION['editmode'] == 'doEdit' ) echo $adminContent;
				else echo $content;
			?>	
				<div id="nieuws">
					<?php
						zien_berichten($db);
					?>
				</div>
		</div>
	</div>
		
		<div id="onderkant">
		Deze site is gemaakt met Myst
		</div>
		
		<div class="dialog" id="prompt">
			<span style="display: none;" id="loggedin">
				<h2>Menu</h2>
				
				<a href="admin">&raquo; Ga naar beheerdersoverzicht</a><br />
				<a href="?p=layout">&raquo; Verander Layout</a><br />
				<?php if ( $_SESSION['editmode'] == 'doEdit' ) { ?><a href="?p=editMode&stop">&raquo; Stop met aanpassen</a><br /><?php } 
				else { ?><a href="?p=editMode">&raquo; Pas de website aan</a><br /><?php } ?><br />
				<a href="admin?a_page=admin_off">&raquo; Log uit</a><br />
			</span>
			
			<span id="loginform">
				<h2>Inloggen</h2>
				
				<form>
					<span style="color: red; font-style: italic;" id="loginmsg"></span>
					<table border="0">
						<tr>
							<td>Gebruikersnaam:&nbsp;</td>
							<td><input id="username" /></td>
						</td>
						<tr>
							<td>Wachtwoord: </td>
							<td><input type="password" id="password" /></td>
						</tr>
					</table>
					<br />
					<button type="submit" class="accept"> Inloggen </button>
					<button type="button" class="close"> Annuleren </button>
				</form>
			</span>
			<br />
		</div>
	</body>
</html>