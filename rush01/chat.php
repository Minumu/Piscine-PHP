<?php
session_start();
?>
<html><head>
    <style>
        .pne_msg {
            color: #fff;
            font-weight: bold;
        }
    </style>
</head></html>
<?php
if (($_SESSION['player1'] && $_SESSION['player1'] != '') || ($_SESSION['player2'] && $_SESSION['player2'] != ''))
{
    $path = array(
        0       => '',
        1       => 'chat'
    );
    $msg  = unserialize(file_get_contents($path[0].$path[1]));
    if (!empty($msg))
    {
        foreach ($msg as $z => $m)
            echo "<div class=\"pne_msg\">[".date('H:i', $m['date'])."] <b>".$m['login']."</b>: ".$m['msg']."</div><br />";
    }
}
else
    echo "ERROR";
echo "\n";