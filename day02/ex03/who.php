#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Kiev');
function who()
{
    $fd = fopen("/var/run/utmpx", "r");
    if (!empty($fd))
    {
        while ($r = fread($fd, 628))
        {
            $who = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host", $r);
            if ($who['type'] == 7)
                $all[] = $who;
        }
        sort($all);
        foreach ($all as $elem)
            print $elem['user'].' '.$elem['line'].'  '.date("M  j H:i", $elem['time1'])."\n";
    }
}
who();

?>