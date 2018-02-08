<?php
session_start();
if (!($_SESSION['player1'] && $_SESSION['player1'] != '') || !($_SESSION['player2'] && $_SESSION['player2'] != ''))
    echo "ERROR\n";
else
{
    if ($_POST['message'])
    {
        $path = array(
            0       => '',
            1       => 'chat'
        );
        if (!file_exists($path[0]))
            mkdir($path[0]);
        if (!file_exists($path[0].$path[1]))
            file_put_contents($path[0].$path[1], null);
        $chat = unserialize(file_get_contents($path[0].$path[1]));
        $msg = array(
            "login" => $_POST['login'],
            "date"  => time(),
            "msg"   => $_POST['message']
        );
        $chat[] = $msg;
        file_put_contents($path[0].$path[1], serialize($chat));
    }
    ?>
    <html>
<head>
    <script language="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
<form action="speak.php" method="post">
    <select id="user" name="login">
        <option value="<?php echo $_SESSION['player1'];?>"><?php echo $_SESSION['player1'];?></option>
        <option value="<?php echo $_SESSION['player2'];?>"><?php echo $_SESSION['player2'];?></option>
    </select>
    <label>
        <input type="text" name="message" value=""/>
        <input type="submit" name="submit" value="Send"/>
    </label>
</form>
</body>
    <?php
}
?>