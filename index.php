<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/fonts.css' />
<link rel='stylesheet' href='css/positioning.css' />
<link rel='stylesheet' href='css/emoji.min.css' />

<img class="background" src='img/background.jpg' />

<?php
//error_reporting(0);

echo "<div class='wrapper " . $_GET['role'] . "'>";

$usedInputs = [];
$config = json_decode(file_get_contents('config.json'), true);

foreach ($config['groups'] as $groupName => $group) {
    $inputs = $group['inputs'];

    if ($_GET['group'] == $groupName && $_GET['role'] != "master") {
        $not_ed = "";
    } else {
        $not_ed = "readonly";
    }

    foreach ($inputs as $inputName => $inp) {
        //Text
        if ($inp['type'] == "text") {
            echo "
			<textarea class='fillable fillable-text' id='" . $inputName . "' " . $not_ed . " placeholder='" . $inp['placeholder'] . "' maxlength='" . $inp['maxlength'] . "'></textarea>
			";
        }

        //Emoji
        elseif ($inp['type'] == "emoji") {

            if (empty($inp['value'])) {
                $inp['value'] = $inp['placeholder'];
            }

            echo "<div id='" . $inputName . "' class='fillable fillable-emoji em' " . $not_ed . "></div>";

            echo "<div class='emoji-list' data-input='" . $inputName . "'>";

            foreach ($inp['emojis'] as $emo) {
                echo "<div class='em " . $emo . "' data-value='" . $emo . "'></div>";
            }

            echo "</div>";
        }

        //Image
        elseif ($inp['type'] == "image") {
            if (empty($inp['value'])) {
                $inp['value'] = $inp['placeholder'];
            }

            echo "<div id='" . $inputName . "' class='fillable fillable-image' " . $not_ed . ">";

            echo "</div>";

            echo "<div class='image-list' data-input='" . $inputName . "'>";

            foreach ($inp['images'] as $src) {
                echo "<div class='image-item' data-value='" . $src . "' style='background-image: url(" . $src . ")'></div>";
            }

            echo "</div>";
        }

        //create file if it doesnt exist yet
        if (!file_exists('data/' . $inputName . '.data')) {
            file_put_contents('data/' . $inputName . '.data', trim($inp['initial-value']));
        }

    }

    $usedInputs = array_merge($usedInputs, array_keys($inputs));
}

echo "</div>";

$savedInputs = str_replace('.data', '', str_replace('data/', '', glob('data/*.data')));
$obsoleteInputs = array_diff($savedInputs, $usedInputs);

foreach ($obsoleteInputs as $ob) {
    unlink('./data/' . $ob . ".data");
}
?>

<script src='js/jquery.min.js'></script>
<script src='js/jquery-ui.min.js'></script>
<script src='js/script.js'></script>
