<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/fonts.css' />
<link rel='stylesheet' href='css/positioning.css' />
<<<<<<< HEAD
<link rel='stylesheet' href='css/emoji.min.css' />
=======
>>>>>>> 281394bda4ef2e39419cc1c097df511db5526e9a

<img src='img/background.jpg' />

<?php
//error_reporting(0);
$usedInputs = [];
$config = json_decode(file_get_contents('config.json'), true);

<<<<<<< HEAD

foreach($config['groups'] as $groupName => $group) {

	$inputs = $group['inputs'];

=======

foreach($config['groups'] as $groupName => $group) {

	$inputs = $group['inputs'];

>>>>>>> 281394bda4ef2e39419cc1c097df511db5526e9a
	if($_GET['group'] == $groupName) {
		$not_ed = "";
	} else {
		$not_ed = "readonly";
	}

	foreach($inputs as $inputName => $inp) {
<<<<<<< HEAD
		if($inp['type'] == "text") {
			echo "
			<textarea id='".$inputName."' ".$not_ed." placeholder='".$inp['placeholder']."' maxlength='".$inp['maxlength']."'>".file_get_contents('data/'.$inputName.'.data')."</textarea>
			";
		} elseif($inp['type'] == "emoji") {
			echo "<div id='".$inputName."' class='emoji-picker em ".file_get_contents('data/'.$inputName.'.data')."' ".$not_ed."></div>";

			echo "<div class='emoji-list' data-input='".$inputName."'>";
			foreach($inp['emojis'] as $emo) {
				echo "<div class='em ".$emo."' data-value='".$emo."'></div>";
			}
			echo "</div>";
		}
=======
		echo "
		<textarea id='".$inputName."' ".$not_ed." placeholder='".$inp['placeholder']."' maxlength='".$inp['maxlength']."'>".file_get_contents('data/'.$inputName.'.data')."</textarea>
		";
>>>>>>> 281394bda4ef2e39419cc1c097df511db5526e9a
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
