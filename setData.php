<?php
file_put_contents('data/' . $_POST['key'] . '.' . $_POST['type'], trim($_POST['value']));
