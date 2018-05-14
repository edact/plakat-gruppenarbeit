<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/fonts.css' />
<link rel='stylesheet' href='css/positioning.css' />
<script src='js/jquery.min.js'></script>
<img src='img/background.jpg' />
<?php
error_reporting(0);
$feldarray = array(
	"1" => array("news1schlag", "news1spruch", "news1text1", "news1text2"),
	"2" => array("news2schlag", "news2text1"),
	"3" => array("news3schlag", "news3text1", "news4schlag", "news4text1"),
	"4" => array("preis",  "preisinfo1a", "preisinfo1b", "preisinfo2a", "Preisinfo2b", "preisinfo3a", "preisinfo3b", "preisinfo4a", "preisinfo4b", "preisinfo5a", "preisinfo5b")
);

foreach($feldarray as $gruppe => $felder) {
	if($_GET['gruppe'] == $gruppe) {
		$not_ed = "";
	} else {
		$not_ed = "readonly";
	}

	foreach($felder as $f) {
		echo "<textarea id='".$f."' ".$class." ".$not_ed.">".file_get_contents('data/'.$f.'.data')."</textarea>";
	}
}
?>
<script src='js/script.js'></script>
