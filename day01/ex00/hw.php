#!/usr/bin/php
<?php

if (!file_exists($argv[1]))
	exit(0);
$fd = fopen($argv[1], 'r');
while (!feof($fd))
{
    $line = fgets($fd);

}


?>
