<html>
<head>
<title>
Layout
</title>

	<script type="text/javascript" src="colorpicker/js/jquery.js"></script>
	<script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
    <script type="text/javascript" src="colorpicker/js/eye.js"></script>
    <script type="text/javascript" src="colorpicker/js/utils.js"></script>
    <script type="text/javascript" src="colorpicker/js/layout.js?ver=1.0.2"></script>
		<link rel="stylesheet" href="colorpicker/css/colorpicker.css" type="text/css" />

</head>
<body>
<form method="post" action="layout.php">
Achtergrond kleur <input type="text"id="kleur1" maxlength="6" size="6" name="body-backgroundcolor"/><br>
Lettertype 
	<select name="body-font">
		<option value="Arial">Arial</option>
		<option value="Arial Narrow">Arial Narrow</option>
		<option value="Calibri">Calibri</option>
		<option value="Comic Sans MS">Comic Sans MS</option>
		<option value="Georgia">Georgia</option>
		<option value="Impact">Impact</option>
		<option value="Lucida Sans">Lucida Sans</option>
		<option value="Times New Roman">Times New Roman</option>
		<option value="Trebuchet MS">Trebuchet MS</option>
		<option value="Verdana">Verdana</option>
	</select>
	<br>
Titelkleur <input type="text"id="kleur2" maxlength="6" size="6" name="head-fontcolor"/><br>
Letterkleur <input type="text"id="kleur3" maxlength="6" size="6" name="body-fontcolor"/><br>
Lettergrootte 
	<select name="body-fontsize">
		<option value="13">13</option>
	</select>
</form> 

<script>
$('#kleur1, #kleur2, #kleur3').ColorPicker({
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

</body>
</html>