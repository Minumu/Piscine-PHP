#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Paris');
function get_month($m, $month)
{
	$i = 0;
	while ($i < 12) {
        if (strcasecmp($m, $month[$i]) === 0)
            return ($i);
        $i++;
    }
 	return (0);
}

$month = array(
    1 => "janvier",
    2 => "février",
    3 => "mars",
    4 => "avril",
    5 => "mai",
    6 => "juin",
    7 => "juillet",
    8 => "août",
    9 => "septembre",
    10 => "octobre",
    11 => "novembre",
    12 => "décembre");

$day = array(
    1 => "lundi",
    2 => "mardi",
    3 => "mercredi",
    4 => "jeudi",
    5 => "vendredi",
    6 => "samedi",
    7 => "dimanche");

	$date = explode(" ", $argv[1]);
	if (count($date) != 5 )
        exit("Wrong Format\n");
	if (preg_match("/^[1-9]$|^[1-2][0-9]$|^3[0-1]$/", $date[1], $date[1]) === 0
		|| preg_match("/^[0-9]{4}$/", $date[3], $date[3]) === 0 ||
		preg_match("/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date[4], $date[4]) === 0)
        exit("Wrong Format\n");
	if (array_search(lcfirst($date[0]), $day) === false ||
        array_search(lcfirst($date[2]), $month) === false)
        exit("Wrong Format\n");
	$timestamp = strtotime($date[3][0]."-".get_month($date[2], $month)."-".$date[1][0]." ".$date[4][0]);
	if ($timestamp)
		echo $timestamp."\n";
	else
		exit("Wrong Format\n");
?>
