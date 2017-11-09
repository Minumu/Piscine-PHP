#!/usr/bin/php
<?php

$replace = preg_replace('|\s+|', ' ', $argv[1]);
echo trim($replace);

?>

