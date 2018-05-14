<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/fonts.css' />
<link rel='stylesheet' href='css/positioning.css' />

<img src='img/background.jpg' />

<?php
//error_reporting(0);
$usedInputs = [];
$config = json_decode(file_get_contents('config.json'), true);


foreach($config['groups'] as $groupName => $group) {

	$inputs = $group['inputs'];

	if($_GET['group'] == $groupName) {
		$not_ed = "";
	} else {
		$not_ed = "readonly";
	}

	foreach($inputs as $inputName => $inp) {
		echo "
		<textarea id='".$inputName."' ".$not_ed." placeholder='".$inp['placeholder']."' maxlength='".$inp['maxlength']."'>".file_get_contents('data/'.$inputName.'.data')."</textarea>
		";
	}

	$usedInputs = array_merge($usedInputs, array_keys($inputs));
}

$savedInputs = str_replace('.data', '', str_replace('data/', '', glob('data/*.data')));
$obsoleteInputs = array_diff($savedInputs, $usedInputs);

foreach ($obsoleteInputs as $ob) {
	unlink('./data/'.$ob.".data");
}
?>

<script src='js/jquery.min.js'></script>
<script src='js/script.js'></script>
