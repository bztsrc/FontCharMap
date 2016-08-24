<html>
<script>
function loadfont() {
	var stl = document.getElementsByTagName('style')[0];
	console.log(stl);
	stl.innerHTML="@font-face { font-family: myFont; src: url("+document.getElementById('font').value+") format('"+document.getElementById('type').value+"'); }";
}
function selectthis(element) {
    var doc = document, range, selection;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();        
        range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
   	document.execCommand('copy');
}
</script>
<style>
</style>
<body>
<h1>Web Font Character Map</h1>
<div style='padding:5px;'>
	Webfont URL: <input type='text' id='font' onchange='loadfont();' size='80'>
	Type: <select id='type'>
		<option>woff</option>
		<option>woff2</option>
		<option>embedded-opentype</option>
		<option>truetype</option>
		<option>svg</option>
	</select>
</div>
<table border='1' cellspacing='0' cellpadding='3'>
<?php
$limit = intval(@$_REQUEST['limit']);
for($y=0;$y<($limit>128&&$limit<4096?$limit:1024);$y++) {
	echo("<tr>");
	for($x=0;$x<8;$x++) {
		$i = $y*8+$x;
		echo("<td style='font-family: myFont;font-size:28px; cursor:pointer;' width='1' onclick='selectthis(this);'>".mb_convert_encoding('&#' . $i . ';', 'UTF-8', 'HTML-ENTITIES')."</td>");
		echo("<td style='cursor:pointer;'><span onclick='selectthis(this);'>&amp;#".$i.";</span><br><span onclick='selectthis(this);'>&amp;#x".sprintf("%04x",$i).";</span></td>");
	}
	echo("</tr>\n");
}
?>
</table>
</body>
</html>