<?php
$mysql_error = false;

if ( $config['errorlvl'] == 1 || $config['errorlvl'] == 2 ) error_reporting(0);
if ( $config['errorlvl'] == 3 ) error_reporting(E_ERROR | E_WARNING | E_PARSE);

function error($str) {
	global $config;
	if ( $config['errorlvl'] == 1 ) {
		echo $str;
		error_reporting(0);
	}
	if ( $config['errorlvl'] == 2 ) {
		echo $str;
		$errorlog = fopen('files/logs/errorlog.txt','a');	
		$dir = @explode("/",$_SERVER['PATH_INFO']);
		$writelog = fwrite($errorlog,date("[d-m-Y G:i:s]")." (".$dir[1].") ".strip_tags($str)."\n");
		
		if ( !$writelog && !is_writeable('files/logs') ) echo '<p style="font-family: 
			Tahoma; font-size: 11px;">Error : Het logfile is niet schrijfbaar. Controleer of de map de juiste rechten heeft. - proPHP</p>';
		else fclose($errorlog);
		error_reporting(0);
	}
	if ( $config['errorlvl'] == 3 ) {
		echo $str;
		$errorlog = fopen('files/logs/errorlog.txt','a');	
		$dir = @explode("/",$_SERVER['PATH_INFO']);
		$writelog = fwrite($errorlog,date("[d-m-Y G:i:s]")." (".$dir[1].") ".strip_tags($str)."\n");
		
		if ( !$writelog && !is_writeable('files/logs') ) echo '<p style="font-family: 
			Tahoma; font-size: 11px;">Error : Het logfile is niet schrijfbaar. Controleer of de map de juiste rechten heeft. - proPHP</p>';
		else fclose($errorlog);
		error_reporting(E_ALL);
	}
}

class Template {
	function show($array,$template = 'index') {
		extract($array,EXTR_OVERWRITE);
		$file = @fopen('files/html/'.$template.'.php','r') or error('<p style="font-family: 
			Tahoma; font-size: 11px;">Template : Het template bestand kon niet gevonden worden. - proPHP</p>');
		$data = fread($file,8000);
		echo eval('?>'.$data);
		return;
	}
}	

class Url {
	function meta_refresh($url,$delay,$die = true) {
		if ( $die == true ) die('<meta http-equiv="refresh" content="'.$delay.';url='.$url.'" />');
		else echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'" />';
	}
	function header_redirect($url) {
		if ( !headers_sent() ) {
			header("HTTP/1.1 302 found");
			header("Location: ".$url);
		}
		else error('<p style="font-family: 
			Tahoma; font-size: 11px;">Url : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden. - proPHP</p>');
		die();
	}
}

class Database {
	function connect($type = 'default') {
		global $config, $mysql_error;
		if ( $type == 'default' ) {
			@mysql_connect($config['host'],$config['user'],$config['pass']) or error('<p style="font-family: 
			Tahoma; font-size: 11px;">Database : Er kon geen verbinding gemaakt worden <i>(' . $config['user'] . '@' . $config['host'] . ')</i> - proPHP</p>');
			@mysql_select_db($config['database']) or error('<p style="font-family: 
			Tahoma; font-size: 11px;">Database : De database kon niet geselecteerd worden <i>(' . $config['database'] . ')</i> - proPHP</p>');
		}
		else {
			extract($type,EXTR_OVERWRITE);
			@mysql_connect($host,$user,$pass) or error('<p style="font-family:
			Tahoma; font-size: 11px;">Database : Er kon geen verbinding gemaakt worden <i>(' . $user . '@' . $host . ')</i> - proPHP</p>');
			@mysql_select_db($database) or error('<p style="font-family:
			Tahoma; font-size: 11px;">Database : De database kon niet geselecteerd worden <i>(' . $database . ')</i> - proPHP</p>');
		}
		if ( $mysql_error && mysql_errno() > 0 ) die();
		if ( mysql_errno() > 0 ) $mysql_error = true;
	}
	function escape($str) {
		$str = htmlspecialchars($str);
		$str = mysql_real_escape_string($str);
		return $str;
	}
	function query($str,$return = 'assoc') {
		global $mysql_error;
		$q = mysql_query($str);
		
		if ( !$q ) {
			if ( $mysql_error ) {
				error('<p style="font-family: Tahoma; font-size: 11px;">Database : SQL fout: <i>(' . mysql_error() . ')</i> - proPHP</p>');
				die();
			}
			error('<p style="font-family: Tahoma; font-size: 11px;">Database : SQL fout: <i>(' . mysql_error() . ')</i> - proPHP</p>');
			$mysql_error = true;
			return false;
		}
		else $mysql_error = false;
		
		if ( $return == 'assoc' ) return @mysql_fetch_assoc($q);
		if ( $return == 'object' ) return @mysql_fetch_object($q);
		if ( $return == 'affected' ) return @mysql_affected_rows($q);
		if ( $return == 'num' ) return @mysql_num_rows($q);
		if ( $return == 'inserted' ) return @mysql_insert_id();
		if ( $return == 'query' ) return $q;	
	}
	function close() {
		mysql_close();
	}
}

class Secure {
	function __construct() {
		global $config;
		Database::connect();
		Database::query("CREATE TABLE IF NOT EXISTS `usrtbl` (
		  `id` int(10) NOT NULL auto_increment,
		  `username` varchar(40) NOT NULL,
		  `password` varchar(40) NOT NULL,
		  `email` varchar(60) NOT NULL,
		  `group` int(10) NOT NULL,
		  `active` int(1) NOT NULL,
		  `ses_id` int(4) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;");
		Database::query("CREATE TABLE IF NOT EXISTS `groups` (
		  `id` int(10) NOT NULL auto_increment,
		  `name` varchar(40) NOT NULL,
		  `description` varchar(200) NOT NULL,
		  `title` varchar(40) NOT NULL,
		  `order` int(10) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;");
		if ( Database::query("SELECT * FROM `usrtbl`","num") < 1 ) {
			Database::query("INSERT INTO `usrtbl` (`username`,`password`,`group`,`active`) VALUES ('admin','".sha1('admin'.$config['salt'])."','1','1')");
			Database::query("INSERT INTO `groups` (`name`,`description`,`title`,`order`) VALUES ('Admin','Administratoren met alle mogelijkheden','Administrator','100')");
			Database::query("INSERT INTO `groups` (`name`,`description`,`title`,`order`) VALUES ('Gebruikers','Gebruikersgroep voor normale leden','Lid','10')");
		}
		Database::close();
	}
	function sync() {
		Database::connect();
		session_start();
		if ( isset($_COOKIE['username']) && isset($_COOKIE['ses_id']) ) {
			$lid = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".Database::escape($_COOKIE['username'])."' AND `ses_id` = '".Database::escape($_COOKIE['ses_id'])."' LIMIT 1");
			if  ( empty($lid['username']) ) return false;
			
			$ses_id = rand(1000,9999);
			$_SESSION['ses_id'] = $ses_id;
			$_SESSION['username'] = $lid['username'];
			$_SESSION['id'] = $lid['id'];
			$_SESSION['group'] = $lid['group'];
			$_SESSION['active'] = $lid['active'];
		}
		Database::close();
	}
		
	function user($user,$pass,$group,$email) {
		global $config;
		Database::connect();
		$q = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".Database::escape($user)."'",'num');
		if ( $q > '0' ) return false;
		$regquery = Database::query("INSERT INTO `usrtbl` (`username`,`password`,`email`,`group`,`active`) VALUES ('".Database::escape($user)."','".sha1(Database::escape($pass).$config['salt'])."','".Database::escape($email)."',".$group."','0')",'inserted');
		
		if ( $regquery > 0 ) {
			if ( $config['stats'] ) Stats::regview($group);
			return true;
		}
		else return false;
		Database::close();
	}
	function group($name,$description,$title,$order) {
		Database::connect();
		$q = Database::query("INSERT INTO `groups` (`name`,`description`,`title`,`order`) VALUES ('".Database::escape($name)."','".Database::escape($description)."','".Database::escape($title)."','".Database::escape($order)."')");
		if ( $q ) return true;
		else return false;
		Database::close();
	}
	function login($username,$password,$lifetime = 0) {
		global $config;
		Database::connect();
		if ( headers_sent() ) {
			error('<p style="font-family: 
			Tahoma; font-size: 11px;">Url : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden. - proPHP</p>');
			return false;
		}
		session_start();
		$lid = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".Database::escape($username)."' AND `password` = '".sha1(Database::escape($password).$config['salt'])."' LIMIT 1");
		if  ( empty($lid['username']) ) return false;
		
		$ses_id = rand(1000,9999);
		$_SESSION['ses_id'] = $ses_id;
		$_SESSION['username'] = $lid['username'];
		
		$q = Database::query("UPDATE `usrtbl` SET `ses_id` = '".$_SESSION['ses_id']."' WHERE `username` = '".$_SESSION['username']."'");
		
		$_SESSION['id'] = $lid['id'];
		
		$_SESSION['group'] = $lid['group'];
		$_SESSION['active'] = $lid['active'];
		
		if ( $lifetime !== 0 ) {
			$lifetime = time() + $lifetime;
			setcookie('username',$_SESSION['username'],$lifetime,'/','.encodor.nl',false,true);
			setcookie('ses_id',$_SESSION['ses_id'],$lifetime,'/','.encodor.nl',false,true);
		}
		if ( isset($_SESSION['username']) ) return true;
		else return false;
		
		Database::close();
	}
	function logout() {
		session_start();
		setcookie('username',$_SESSION['username'],1,'/','.encodor.nl',false,true);
		setcookie('ses_id',$_SESSION['ses_id'],1,'/','.encodor.nl',false,true);
		unset($_SESSION);
		session_destroy();
	}
	function access() {
		Database::connect();
		if ( headers_sent() ) {
			error('<p style="font-family: 
			Tahoma; font-size: 11px;">Secure : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden. - proPHP</p>');
			return false;
		}
		session_start();
		
		$lid = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".$_SESSION['username']."' AND `ses_id` = '".$_SESSION['ses_id']."' LIMIT 1");
		if ( !empty($lid['group']) ) return $lid['group'];
		
		$lid = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".$_COOKIE['username']."' AND `ses_id` = '".$_COOKIE['ses_id']."' LIMIT 1");
		if ( !empty($lid['group']) ) return $lid['group'];
		else return false;			
		Database::close();
	}
	function active($user) {
		Database::connect();
		if ( headers_sent() ) {
			error('<p style="font-family: 
			Tahoma; font-size: 11px;">Secure : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden. - proPHP</p>');
			return false;
		}
		session_start();
		
		$lid = Database::query("SELECT * FROM `usrtbl` WHERE `username` = '".$user."' LIMIT 1");
		return $lid['active'];
		Database::close();
	}
	function activate($user) {
		Database::connect();
		if ( headers_sent() ) {
			error('<p style="font-family: 
			Tahoma; font-size: 11px;">Secure : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden. - proPHP</p>');
			return false;
		}
		session_start();
		
		$lid = Database::query("UPDATE `usrtbl` SET `active` = '1' WHERE `username` = '".$user."' LIMIT 1");
		Database::close();
	}
}

class Log {
	function read($log = 'errorlog') {
		$logfile = file_get_contents('files/logs/'.$log.'.txt');
		if ( !$logfile ) error('<p style="font-family: 
			Tahoma; font-size: 11px;">Log : Het log ('.$log.'.txt) kon niet ingelezen worden. - proPHP</p>');
		else return $logfile;
	}
	function create($log = 'errorlog') {
		$log = fopen('files/logs/'.$log.'.txt','a');
		if ( !$log ) {
			error('<p style="font-family: 
				Tahoma; font-size: 11px;">Log : Het log ('.$log.'.txt) kon niet aangemaakt worden. - proPHP</p>');
			return false;
		}
		else {
			$writelog = fwrite($log," ");
			return true;
		}
	}
		
	function delete($log = 'errorlog') {
		if ( !unlink('files/logs/'.$log.'.txt') ) {
			error('<p style="font-family: 
				Tahoma; font-size: 11px;">Log : Het log ('.$log.'.txt) kon niet verwijderd worden. - proPHP</p>');
			return false;
		}
		else return true;
	}
	function write($name,$str) {
		$log = fopen('files/logs/'.$name.'.txt','a');		
		$writelog = fwrite($log,date("[d-m-Y G:i:s]")." ".strip_tags($str)."\n");
		
		if ( !$writelog && !is_writeable('files/logs') ) echo '<p style="font-family: 
			Tahoma; font-size: 11px;">Error : Het logfile is niet schrijfbaar. Controleer of de map de juiste rechten heeft. - proPHP</p>';
		else fclose($log);
	}	
}	

class Stats {
	function __construct() {
		global $config;
		Database::connect();
		Database::query("CREATE TABLE IF NOT EXISTS `stats` (
		  `id` int(10) NOT NULL auto_increment,
		  `item` varchar(40) NOT NULL,
		  `event` varchar(40) NOT NULL,
		  `views` int(10) NOT NULL,
		  `todayviews` int(10) NOT NULL,
		  `date` int(10) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;");
		Database::close();
	}
	function pageview($page) {
		Database::connect();
		$q = Database::query("SELECT * FROM `stats` WHERE `item` = '".$page."' AND `event` = 'page'");
		if ( isset($q['views']) ) {
			$q['views']++;
			$q['todayviews']++;
			if ( $q['date'] == date("j") ) Database::query("UPDATE `stats` SET `views` = '".$q['views']."', `todayviews` = '".$q['todayviews']."' WHERE `item` = '".$page."' AND `event` = 'page'");
			if ( $q['date'] !== date("j") ) Database::query("UPDATE `stats` SET `views` = '".$q['views']."', `todayviews` = '1', `date` = '".date("j")."' WHERE `item` = '".$page."' AND `event` = 'page'");
			
		}
		else Database::query("INSERT INTO `stats` (`item`,`event`,`views`,`todayviews`,`date`) VALUES ('".$page."','page','1','1','".date("j")."')");
		Database::close();
	}
	function regview($level) {
		Database::connect();
		$q = Database::query("SELECT * FROM `stats` WHERE `item` = '".$level."' AND `event` = 'register'");
		if ( isset($q['views']) ) {
			$q['views']++;
			$q['todayviews']++;
			if ( $q['date'] == date("j") ) Database::query("UPDATE `stats` SET `views` = '".$q['views']."', `todayviews` = '".$q['todayviews']."' WHERE `item` = '".$page."' AND `event` = 'register'");
			if ( $q['date'] !== date("j") ) Database::query("UPDATE `stats` SET `views` = '".$q['views']."', `todayviews` = '1', `date` = '".date("j")."' WHERE `item` = '".$page."' AND `event` = 'register'");	
		}
		else Database::query("INSERT INTO `stats` (`item`,`event`,`views`,`todayviews`,`date`) VALUES ('".$level."','register','1','1','".date("j")."')");
		Database::close();
	}
	function showregview($level,$time = 'all') {
		Database::connect();
		$q = Database::query("SELECT * FROM `stats` WHERE `item` = '".$level."' AND `event` = 'register'");
		if ( $time == 'all' ) return $q['views'];
		if ( $time == 'today' ) return $q['todayviews'];
		Database::close();
	}
}

class Paypal {
    
   var $last_error;                 // holds the last error encountered
   
   var $ipn_log;                    // bool: log IPN results to text file?
   
   var $ipn_log_file;               // filename of the IPN log
   var $ipn_response;               // holds the IPN response from paypal   
   var $ipn_data = array();         // array contains the POST values for IPN
   
   var $fields = array();           // array holds the fields to submit to paypal

   
   function __construct() {
       
      // initialization constructor.  Called when class is created.
      
      $this->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
      
      $this->last_error = '';
      
      $this->ipn_log_file = '.ipn_results.log';
      $this->ipn_log = true; 
      $this->ipn_response = '';
      
      // populate $fields array with a few default values.  See the paypal
      // documentation for a list of fields and their data types. These defaul
      // values can be overwritten by the calling script.

      $this->add_field('rm','2');           // Return method = POST
      $this->add_field('cmd','_xclick'); 
      
   }
   
   function add_field($field, $value) {
      
      // adds a key=>value pair to the fields array, which is what will be 
      // sent to paypal as POST variables.  If the value is already in the 
      // array, it will be overwritten.
            
      $this->fields["$field"] = $value;
   }

   function submit_paypal_post() {
 
      // this function actually generates an entire HTML page consisting of
      // a form with hidden elements which is submitted to paypal via the 
      // BODY element's onLoad attribute.  We do this so that you can validate
      // any POST vars from you custom form before submitting to paypal.  So 
      // basically, you'll have your own form which is submitted to your script
      // to validate the data, which in turn calls this function to create
      // another hidden form and submit to paypal.
 
      // The user will briefly see a message on the screen that reads:
      // "Please wait, your order is being processed..." and then immediately
      // is redirected to paypal.

      echo "<html>\n";
      echo "<head><title>Verbinden met paypal...</title></head>\n";
      echo "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
      echo "<center><h2>Even geduld, uw bestelling wordt verwerkt en u";
      echo " wordt doorgestuurd naar de paypal website.</h2></center>\n";
      echo "<form method=\"post\" name=\"paypal_form\" ";
      echo "action=\"".$this->paypal_url."\">\n";

      foreach ($this->fields as $name => $value) {
         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
      }
      echo "<center><br/><br/>Als u niet automatisch wordt doorgestuurd ";
      echo "naar de paypal website...<br/><br/>\n";
      echo "<input type=\"submit\" value=\"Klik hier\"></center>\n";
      
      echo "</form>\n";
      echo "</body></html>\n";
    
   }
   
   function validate_ipn() {

      // parse the paypal URL
      $url_parsed=parse_url($this->paypal_url);        

      // generate the post string from the _POST vars aswell as load the
      // _POST vars into an arry so we can play with them from the calling
      // script.
      $post_string = '';    
      foreach ($_POST as $field=>$value) { 
         $this->ipn_data["$field"] = $value;
         $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
      }
      $post_string.="cmd=_notify-validate"; // append ipn command

      // open the connection to paypal
      $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30); 
      if(!$fp) {
          
         // could not open the connection.  If loggin is on, the error message
         // will be in the log.
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->log_ipn_results(false);       
         return false;
         
      } else { 
 
         // Post the data back to paypal
         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n"); 
         fputs($fp, "Host: $url_parsed[host]\r\n"); 
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
         fputs($fp, "Connection: close\r\n\r\n"); 
         fputs($fp, $post_string . "\r\n\r\n"); 

         // loop through the response from the server and append to variable
         while(!feof($fp)) { 
            $this->ipn_response .= fgets($fp, 1024); 
         } 

         fclose($fp); // close connection

      }
      
      if (eregi("VERIFIED",$this->ipn_response)) {
  
         // Valid IPN transaction.
         $this->log_ipn_results(true);
         return true;       
         
      } else {
  
         // Invalid IPN transaction.  Check the log for details.
         $this->last_error = 'IPN Validation Failed.';
         $this->log_ipn_results(false);   
         return false;
         
      }
      
   }
   
   function log_ipn_results($success) {
       
      if (!$this->ipn_log) return;  // is logging turned off?
      
      // Timestamp
      $text = '['.date('m/d/Y g:i A').'] - '; 
      
      // Success or failure being logged?
      if ($success) $text .= "SUCCESS!\n";
      else $text .= 'FAIL: '.$this->last_error."\n";
      
      // Log the POST variables
      $text .= "IPN POST Vars from Paypal:\n";
      foreach ($this->ipn_data as $key=>$value) {
         $text .= "$key=$value, ";
      }
 
      // Log the response from the paypal server
      $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;
      
      // Write to log
      $fp=fopen($this->ipn_log_file,'a');
      fwrite($fp, $text . "\n\n"); 

      fclose($fp);  // close file
   }

   function dump_fields() {
 
      // Used for debugging, this function will output all the field/value pairs
      // that are currently defined in the instance of the class using the
      // add_field() function.
      
      echo "<h3>paypal_class->dump_fields() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>"; 
      
      ksort($this->fields);
      foreach ($this->fields as $key => $value) {
         echo "<tr><td>$key</td><td>".urldecode($value)."&nbsp;</td></tr>";
      }
 
      echo "</table><br>"; 
   }
}
	
?>