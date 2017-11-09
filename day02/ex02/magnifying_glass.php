#!/usr/bin/php

<?php

if (!file_exists($argv[1]))
    exit();

$fd = fopen($argv[1], 'r');
while (!feof($fd))
    $line .= fgets($fd);
$line = preg_replace_callback('/<a.*?>(.*?)</', function ($replace)
{
    return (str_replace($replace[1], strtoupper($replace[1]), $replace[0]));
}, $line);
$line = preg_replace_callback('/title="(.*?)">/', function ($replace)
{
    return (str_replace($replace[1], strtoupper($replace[1]), $replace[0]));
}, $line);
echo ($line);

?>