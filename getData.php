<?php
foreach (glob('data/*') as $file) {
    $fileInfo = pathinfo($file);
    $ret[$fileInfo['filename']][$fileInfo['extension']] = file_get_contents($file);
}

echo json_encode($ret);
