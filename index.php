<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/fonts.css' />
<link rel='stylesheet' href='css/positioning.css' />
<script src='js/jquery.min.js'></script>
<img src='img/background.jpg' />
<?php
error_reporting(0);
$feldarray = json_encode(file_get_contents('config.json'), true);

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
