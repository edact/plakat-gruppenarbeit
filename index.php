<?php
function prar($val)
{
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
//error_reporting(0);

if (empty($_GET['poster'])) {
    exit("no poster selected");
}

$usedInputs = [];
$config = json_decode(file_get_contents('config.json'), true);

if (!empty($_GET['poster']) && !in_array($_GET['poster'], array_keys($config))) {
    exit("selected poster does not exist");
}

$poster = $config[$_GET['poster']];

if (!empty($_GET['group']) && !in_array($_GET['group'], array_keys($poster['groups']))) {
    exit("selected group does not exist");
}

foreach ($poster['fillables'] as $key => $fillable) {
    if ($fillable['type'] == "external") {
        $poster['fillables'][$key] = $config[$fillable['source-poster']]['fillables'][$fillable['source-fillable']];
    }
}
?>
<link rel='stylesheet' href='css/style.css' />
<link rel='stylesheet' href='css/typography.css' />
<link rel='stylesheet' href='css/emoji.min.css' />
<link rel='stylesheet' href='css/jquery-ui.min.css' />

<img class="background" src='img/background.jpg' />

<?php

echo "<div class='wrapper " . $_GET['role'] . "'>";

$nonexistent = 0;

foreach ($poster['fillables'] as $inputName => $inp) {

    if (in_array($inputName, $poster['groups'][$_GET['group']])) {
        $not_ed = "";
    } else {
        $not_ed = "readonly";
    }
    //Text
    if ($inp['type'] == "text") {
        echo "
			<div class='fillable fillable-text' data-identifier='" . $inputName . "' " . $not_ed . "><textarea id='" . $inputName . "' maxlength='" . $inp['maxlength'] . "' " . $not_ed . "></textarea></div>
			";
    }

    //Emoji
    elseif ($inp['type'] == "emoji") {

        if (empty($inp['value'])) {
            $inp['value'] = $inp['placeholder'];
        }

        echo "<div data-identifier='" . $inputName . "' class='fillable fillable-emoji em' " . $not_ed . "></div>";

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

        echo "<div data-identifier='" . $inputName . "' class='fillable fillable-image' " . $not_ed . ">";

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
        file_put_contents('data/' . $inputName . '.top', "10px");
        file_put_contents('data/' . $inputName . '.left', ($nonexistent * 110 + 10) . "px");
        file_put_contents('data/' . $inputName . '.height', "100px");
        file_put_contents('data/' . $inputName . '.width', "100px");
        $nonexistent++;
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
