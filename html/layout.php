	<?php
		// controle  post
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			//gegevens die zijn doorgestuurd worden opgeslagen
			$bodybackgroundcolor =  "#".$_POST['bodybackgroundcolor'];
			$headfontcolor =  "#".$_POST['headfontcolor'];
			$bodyfont =  '"'.$_POST['bodyfont'].'"';
			$bodyfontcolor =  "#".$_POST['bodyfontcolor'];
			$bodyfontsize =  $_POST['bodyfontsize'];
			$headbackgroundcolor =  "#".$_POST['headbackgroundcolor'];
			$menucolor =  "#".$_POST['menucolor'];
			$menubuttonfontcolor =  "#".$_POST['menubuttonfontcolor'];
			$menuhoverbackcolor =  "#".$_POST['menuhoverbackcolor'];
			$menuhoverfontcolor =  "#".$_POST['menuhoverfontcolor'];
			$alinkcolor =  "#".$_POST['alinkcolor'];
			$avisitedcolor =  "#".$_POST['alinkcolor'];
			$ahovercolor =  "#".$_POST['ahovercolor'];
			$aactivecolor =  "#".$_POST['ahovercolor'];

			$db =  new Mysqli("sql09.freemysql.net" , "projectmyst" , "GitMyst", "projectmyst", 3306) or die("Fout! De computer mag je niet!");
			$db->query("UPDATE layout SET value = '".$bodybackgroundcolor."' WHERE layouttype = 'body-backgroundcolor'");
			$db->query("UPDATE layout SET value = '".$headfontcolor."' WHERE layouttype = 'head-fontcolor'");
			$db->query("UPDATE layout SET value = '".$bodyfont."' WHERE layouttype = 'body-font'");
			$db->query("UPDATE layout SET value = '".$bodyfontcolor."' WHERE layouttype = 'body-fontcolor'");
			$db->query("UPDATE layout SET value = '".$bodyfontsize."' WHERE layouttype = 'body-fontsize'");
			$db->query("UPDATE layout SET value = '".$headbackgroundcolor."' WHERE layouttype = 'head-backgroundcolor'");
			$db->query("UPDATE layout SET value = '".$menucolor."' WHERE layouttype = 'menu-color'");
			$db->query("UPDATE layout SET value = '".$menubuttonfontcolor."' WHERE layouttype = 'menubutton-fontcolor'");
			$db->query("UPDATE layout SET value = '".$menuhoverbackcolor."' WHERE layouttype = 'menuhover-backcolor'");
			$db->query("UPDATE layout SET value = '".$menuhoverfontcolor."' WHERE layouttype = 'menuhover-fontcolor'");
			$db->query("UPDATE layout SET value = '".$alinkcolor."' WHERE layouttype = 'a-linkcolor'");
			$db->query("UPDATE layout SET value = '".$avisitedcolor."' WHERE layouttype = 'a-visitedcolor'");
			$db->query("UPDATE layout SET value = '".$ahovercolor."' WHERE layouttype = 'a-hovercolor'");
			$db->query("UPDATE layout SET value = '".$aactivecolor."' WHERE layouttype = 'a-activecolor'");
			}
		?>	
<table cellpadding ="5" STYLE = "font-size : 13pt">
	<form name="layout" method="post" action="#saved">
	<tr>
		<td>
			Achtergrond kleur 
		</td>
		<td>
			<input type="text"id="kleur1" maxlength="6" size="6" 
			value =  "<?php
						$db =  new Mysqli("sql09.freemysql.net" , "projectmyst" , "GitMyst", "projectmyst", 3306) or die("Fout! De computer mag je niet!");
						
						$bodybackgroundcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'body-backgroundcolor'");
						$bodybackgroundcolor = $bodybackgroundcolor->fetch_assoc();
						$bodybackgroundcolor = $bodybackgroundcolor['value'];
						$bodybackgroundcolor = str_ireplace("#","",$bodybackgroundcolor);
						print($bodybackgroundcolor);
						?>"
			name="bodybackgroundcolor"/>
		</td>
	</tr>
	<tr>
		<td>
			Lettertype 
		</td>
		<td>
			<?php
				$bodyfont = $db->query("SELECT value FROM layout WHERE layouttype ='body-font'");
				$bodyfont = $bodyfont->fetch_assoc();
				$bodyfont = $bodyfont['value'];
			?>
		<select name="bodyfont">
				<option value="Arial" <?php if($bodyfont == '"Arial"' ) {print("SELECTED");}?>>Arial</option>
				<option value="Arial Narrow"	<?php if($bodyfont == '"Arial Narrow"' ) {print("SELECTED");}?>>Arial Narrow</option>
				<option value="Calibri" <?php if($bodyfont == '"Calibri"' ) {print("SELECTED");}?>>Calibri</option>
				<option value="Comic Sans MS" <?php if($bodyfont == '"Comic Sans MS"' ) {print("SELECTED");}?>>Comic Sans MS</option>
				<option value="Georgia" <?php if($bodyfont == '"Georgia"' ) {print("SELECTED");}?>>Georgia</option>
				<option value="Impact" <?php if($bodyfont == '"Impact"' ) {print("SELECTED");}?>>Impact</option>
				<option value="Lucida Sans" <?php if($bodyfont == '"Lucida Sans"' ) {print("SELECTED");}?>>Lucida Sans</option>
				<option value="Times New Roman" <?php if($bodyfont == '"Times New Roman"' ) {print("SELECTED");}?>>Times New Roman</option>
				<option value="Trebuchet MS" <?php if($bodyfont == '"Trebuchet MS"' ) {print("SELECTED");}?>>Trebuchet MS</option>
				<option value="Verdana" <?php if($bodyfont == '"Verdana"' ) {print("SELECTED");}?>>Verdana</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Titelkleur 
		</td>
		<td>
			<input type="text"id="kleur2" maxlength="6" size="6" name="headfontcolor"
				value =	"<?php
					$headfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'head-fontcolor'");
					$headfontcolor = $headfontcolor->fetch_assoc();
					$headfontcolor = $headfontcolor['value'];
					$headfontcolor = str_ireplace("#","",$headfontcolor);
					print($headfontcolor);
					?>"/>
		</td>
	</tr>
	<tr>
		<td>
			Letterkleur
		</td>
		<td>
			<input type="text"id="kleur3" maxlength="6" size="6" name="bodyfontcolor"
				value = "<?php
						$bodyfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'body-fontcolor'");
						$bodyfontcolor = $bodyfontcolor->fetch_assoc();
						$bodyfontcolor = $bodyfontcolor['value'];
						$bodyfontcolor = str_ireplace("#","",$bodyfontcolor);
						print($bodyfontcolor);
						?>"/>
		</td>
	</tr>
	<tr>
		<td>
			Lettergrootte 	
		</td>
		<td>
			<?php
			//variabele bodyfontsize wordt opgehaald
			$bodyfontsize = $db->query("SELECT value FROM layout WHERE layouttype ='body-fontsize'");
			$bodyfontsize = $bodyfontsize->fetch_assoc();
			$bodyfontsize = $bodyfontsize['value'];
			?>
			<select name="bodyfontsize">
				<option value="6pt" <?php if($bodyfontsize == "6pt") {print("SELECTED");}?>>6</option>
				<option value="8pt" <?php if($bodyfontsize == "8pt") {print("SELECTED");}?>>8</option>
				<option value="10pt" <?php if($bodyfontsize == "10pt") {print("SELECTED");}?>>10</option>
				<option value="11pt" <?php if($bodyfontsize == "11pt") {print("SELECTED");}?>>11</option>
				<option value="12pt" <?php if($bodyfontsize == "12pt") {print("SELECTED");}?>>12</option>
				<option value="13pt" <?php if($bodyfontsize == "13pt") {print("SELECTED");}?>>13</option>
				<option value="14pt" <?php if($bodyfontsize == "14pt") {print("SELECTED");}?>>14</option>
				<option value="16pt" <?php if($bodyfontsize == "16pt") {print("SELECTED");}?>>16</option>
				<option value="18pt" <?php if($bodyfontsize == "18pt") {print("SELECTED");}?>>18</option>
				<option value="20pt" <?php if($bodyfontsize == "20pt") {print("SELECTED");}?>>20</option>
				<option value="22pt" <?php if($bodyfontsize == "22pt") {print("SELECTED");}?>>22</option>
				<option value="24pt" <?php if($bodyfontsize == "24pt") {print("SELECTED");}?>>24</option>
				<option value="26pt" <?php if($bodyfontsize == "26pt") {print("SELECTED");}?>>26</option>
				<option value="28pt" <?php if($bodyfontsize == "28pt") {print("SELECTED");}?>>28</option>
				<option value="30pt" <?php if($bodyfontsize == "30pt") {print("SELECTED");}?>>30</option>
				<option value="32pt" <?php if($bodyfontsize == "32pt") {print("SELECTED");}?>>32</option>
				<option value="34pt" <?php if($bodyfontsize == "34pt") {print("SELECTED");}?>>34</option>
				<option value="36pt" <?php if($bodyfontsize == "36pt") {print("SELECTED");}?>>36</option>
				<option value="38pt" <?php if($bodyfontsize == "38pt") {print("SELECTED");}?>>38</option>
				<option value="40pt" <?php if($bodyfontsize == "40pt") {print("SELECTED");}?>>40</option>	
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Titelbalkkleur
		</td>
		<td>
			<input type="text"id="kleur4" maxlength="6" size="6" name="headbackgroundcolor"
				value = "<?php
						$headbackgroundcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'head-backgroundcolor'");
						$headbackgroundcolor = $headbackgroundcolor->fetch_assoc();
						$headbackgroundcolor = $headbackgroundcolor['value'];
						$headbackgroundcolor = str_ireplace("#","",$headbackgroundcolor);
						print($headbackgroundcolor);?>"
						/>
		</td>
	</tr>
	<tr>
		<td>
			Menukleur
		</td>
		<td>
			<input type="text"id="kleur5" maxlength="6" size="6" name="menucolor"
				value = "<?php
						$menucolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menu-color'");
						$menucolor = $menucolor->fetch_assoc();
						$menucolor = $menucolor['value'];
						$menucolor = str_ireplace("#","",$menucolor);
						print($menucolor);?>"
			/>
		</td>
	</tr>
	<tr>
		<td>
			Menuletterkleur	
		</td>
		<td>
			<input type="text"id="kleur6" maxlength="6" size="6" name="menubuttonfontcolor"
				value = "<?php
					$menubuttonfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menubutton-fontcolor'");
					$menubuttonfontcolor = $menubuttonfontcolor->fetch_assoc();
					$menubuttonfontcolor = $menubuttonfontcolor['value'];
					$menubuttonfontcolor = str_ireplace("#","",$menubuttonfontcolor);
					print($menubuttonfontcolor);?>"
			/>
		</td>
	</tr>
	<tr>
		<td>
			Menukleur (geselecteerd) 
		</td>
		<td>
			<input type="text"id="kleur7" maxlength="6" size="6" name="menuhoverbackcolor"
				value = "<?php
						$menuhoverbackcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menuhover-backcolor'");
						$menuhoverbackcolor = $menuhoverbackcolor->fetch_assoc();
						$menuhoverbackcolor = $menuhoverbackcolor['value'];
						$menuhoverbackcolor = str_ireplace("#","",$menuhoverbackcolor);
						print($menuhoverbackcolor);?>"
			/><br>	
		</td>
	</tr>
	<tr>
		<td>
			Menuletterkleur (geselecteerd)
		</td>
		<td>
			<input type="text"id="kleur8" maxlength="6" size="6" name="menuhoverfontcolor"
				value 	= "<?php
						$menuhoverfontcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'menuhover-fontcolor'");
						$menuhoverfontcolor = $menuhoverfontcolor->fetch_assoc();
						$menuhoverfontcolor = $menuhoverfontcolor['value'];
						$menuhoverfontcolor = str_ireplace("#","",$menuhoverfontcolor);
						print($menuhoverfontcolor);?>"
			/><br>
		</td>
	</tr>
	<tr>
		<td>
			Linkkleur
		</td>
		<td>
			<input type="text"id="kleur9" maxlength="6" size="6" name="alinkcolor"
				value 	= "<?php
						$alinkcolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-linkcolor'");
						$alinkcolor = $alinkcolor->fetch_assoc();
						$alinkcolor = $alinkcolor['value'];
						$alinkcolor = str_ireplace("#","",$alinkcolor);
						print($alinkcolor);?>"
			/><br>
		</td>
	</tr>
	<tr>
		<td>
			Linkkleur (geselecteerd)
		</td>
		<td>
			<input type="text"id="kleur10" maxlength="6" size="6" name="ahovercolor"
				value 	= "<?php
						$ahovercolor = $db->query("SELECT value FROM layout WHERE layouttype = 'a-hovercolor'");
						$ahovercolor = $ahovercolor->fetch_assoc();
						$ahovercolor = $ahovercolor['value'];
						$ahovercolor = str_ireplace("#","",$ahovercolor);
						print($ahovercolor);?>"
			/><br>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<input type="submit" value="Opslaan" name="opslaan">
		</td>
	</tr>
	</form> 
</table>
<script>
$('#kleur1, #kleur2, #kleur3, #kleur4, #kleur5, #kleur6, #kleur7, #kleur8, #kleur9, #kleur10').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
</script>
<br>
<b>Voorbeeld</b><br>
Hebban olla vogala nestas hagunnan hinase hic anda thu, wat unbidan we nu?<br>
<a>Link</a>