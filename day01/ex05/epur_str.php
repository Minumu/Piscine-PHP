#!/usr/bin/php
<?php

$split = array_filter(explode(' ', $argv[1]));
$result = "";
foreach ($split as $elem)
{
	$result = $result.$elem." ";
}
echo trim($result)."\n";

?>