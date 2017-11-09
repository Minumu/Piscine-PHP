#!/usr/bin/php
<?php

$str = "";
$i = 1;
while ($i < $argc)
{
	$str = $str.$argv[$i]." ";
	$i++;
}
$tab = array_filter(explode(' ', $str));
sort($tab);
foreach ($tab as $elem)
{
	echo $elem."\n";
}

?>