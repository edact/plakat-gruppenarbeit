<?php
foreach (glob('data/*.data') as $file) {
    $ret[basename($file, '.data')] = file_get_contents($file);
}

echo json_encode($ret);
?>