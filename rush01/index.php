<?php
session_start();
//session_unset();
if (!isset($_SESSION["logged"]))
    header("location: ./register.php");
if (!isset($_SESSION["ship1"]))
{
    $_SESSION["ship1"] = array(0, 0);
    $_SESSION["ship2"] = array(99, 149);
//    $_SESSION["ship2"] = array(3, 3);
    $_SESSION["rocks"] = Array(2 => 4, 3 => 5, 6 => 8, 30 => 34, 45 => 13, 52 => 89, 90 => 140, 97 => 145);
    $_SESSION["pp1"] = 20;
    $_SESSION["pp2"] = 0;
    $_SESSION["hp1"] = 100;
    $_SESSION["hp2"] = 100;

    
    
//    echo "<script>alert('Here point should be taken from the enemy')</script>";


    if (!($_COOKIE[$_SESSION["player1"]]))
        setcookie($_SESSION["player1"], 0, time() + 3600);
    if (!($_COOKIE[$_SESSION["player2"]]))
        setcookie($_SESSION["player2"], 0, time() + 3600);
}
require_once "Map.class.php"
?>
<html>
<head>
    <style>
        table
        {
            border-collapse: collapse;
            margin: 2vw;
        }
        th, td {
            border: 1px solid rgba(255, 255, 255, .5);
            border-opacity: 0.5;
            border-collapse: collapse;
            height: 0.67vw;
            width: 0.67vw;
            font-size: 0.3vw;
        }
        .left {
            width: 50%;
            text-align: center;
            color: white;
        }
        .right {
            width: 50%;
            text-align: center;
            color: white;
        }
        .clearfix:after{content:''; display:block; clear:both;}
        .fl {float:left;}

    </style>

</head>

<body style=" background-image: url(https://static.pexels.com/photos/110854/pexels-photo-110854.jpeg); ">
<div class="clearfix battle">
<?php
$implement = new map();

function check_if_enermy_in_range($nb)
{
    if ($nb == 1) {
        for ($x = $_SESSION["ship1"][0] - 2; $x < $_SESSION["ship1"][0] + 3; $x++) {
            for ($y = $_SESSION["ship1"][1] - 2; $y < $_SESSION["ship1"][1] + 3; $y++) {
                if ($x == $_SESSION["ship2"][1] && $y == $_SESSION["ship2"][0])
                    return 1;
            }
        }
        return 0;
    } else {
        for ($x = $_SESSION["ship2"][0] - 2; $x < $_SESSION["ship2"][0] + 3; $x++) {
            for ($y = $_SESSION["ship2"][1] - 2; $y < $_SESSION["ship2"][1] + 3; $y++) {
                if ($x == $_SESSION["ship1"][1] && $y == $_SESSION["ship1"][0])
                    return 1;
            }
        }
        return 0;
    }
}

if (isset($_POST["player"]) && isset($_POST["dir"]))
{
    if (+$_POST["player"] == 1 && $_SESSION["pp2"] == 0 && $_SESSION["pp1"] > 0)
    {
        if ($_POST["dir"] == "left")
            $_SESSION["ship1"][1] -= 1;
        else if ($_POST["dir"] == "right")
            $_SESSION["ship1"][1] += 1;
        else if ($_POST["dir"] == "top")
            $_SESSION["ship1"][0] -= 1;
        else if ($_POST["dir"] == "bottom")
            $_SESSION["ship1"][0] += 1;
        else if ($_POST["dir"] == "attack") {
            if (check_if_enermy_in_range(1)) {
                $_SESSION["hp2"] -= 20;
                if ($_SESSION["hp2"] == 0) {
                    echo "<h1 style=\"color: white\" >Winner is {$_SESSION['player1']}</h1>";
                    $i = ($_COOKIE[$_SESSION["player1"]]) + 1;
                    setcookie($_SESSION["player1"], $i, time() + 3600);
                    session_unset();
                    exit();
                }
            }

        }
        if ($_SESSION["ship1"][1] < 0 || $_SESSION["ship1"][1] > 149 || $_SESSION["ship1"][0] < 0 || $_SESSION["ship1"][0] > 99)
        {
            echo "<h1 style=\"color: white\">Winner is {$_SESSION['player2']}</h1>";
            $i = ($_COOKIE[$_SESSION["player2"]]) + 1;
            setcookie($_SESSION["player2"], $i, time() + 3600);
            session_unset();
            exit();
        }
        else if (array_key_exists($_SESSION["ship1"][0], $_SESSION["rocks"]) && $_SESSION["ship1"][1] == ($_SESSION["rocks"][$_SESSION["ship1"][0]]))
        {
            echo "<h1 style=\"color: white\">Winner is {$_SESSION['player2']}</h1>";
            $i = ($_COOKIE[$_SESSION["player2"]]) + 1;
            setcookie($_SESSION["player2"], $i, time() + 3600);
            session_unset();
            exit();
        }
        $_SESSION["pp1"]--;
        if ($_SESSION["pp1"] == 0)
            $_SESSION["pp2"] = 20;

    }
    else if (+$_POST["player"] == 2 && $_SESSION["pp1"] == 0 && $_SESSION["pp2"] > 0)
    {
        if ($_POST["dir"] == "left")
            $_SESSION["ship2"][1] -= 1;
        else if ($_POST["dir"] == "right")
            $_SESSION["ship2"][1] += 1;
        else if ($_POST["dir"] == "top")
            $_SESSION["ship2"][0] -= 1;
        else if ($_POST["dir"] == "bottom")
            $_SESSION["ship2"][0] += 1;
        else if ($_POST["dir"] == "attack") {
            if (check_if_enermy_in_range(2)) {
                $_SESSION["hp1"] -= 20;
//                echo "<script>alert('Here point should be taken from the enemy')</script>";
                if ($_SESSION["hp1"] == 0) {
                    echo "<h1 style=\"color: white\" >Winner is {$_SESSION['player2']}</h1>";
                    $i = ($_COOKIE[$_SESSION["player2"]]) + 1;
                    setcookie($_SESSION["player2"], $i, time() + 3600);
                    session_unset();
                    exit();
                }
            }

        }
        if ($_SESSION["ship2"][1] < 0 || $_SESSION["ship2"][1] > 149 || $_SESSION["ship2"][0] < 0 || $_SESSION["ship2"][0] > 99)
        {
            echo "<h1 style=\"color: white\" >Winner is {$_SESSION['player1']}</h1>";
            $i = ($_COOKIE[$_SESSION["player1"]]) + 1;
            setcookie($_SESSION["player1"], $i, time() + 3600);
            session_unset();
            exit();
        }
        else if (array_key_exists($_SESSION["ship2"][0], $_SESSION["rocks"]) && $_SESSION["ship2"][1] == ($_SESSION["rocks"][$_SESSION["ship2"][0]]))
        {
            echo "<h1 style=\"color: white\" >Winner is {$_SESSION['player1']}</h1>";
            $i = ($_COOKIE[$_SESSION["player1"]]) + 1;
            setcookie($_SESSION["player1"], $i, time() + 3600);
            session_unset();
            exit();
        }
        $_SESSION["pp2"]--;
        if ($_SESSION["pp2"] == 0)
            $_SESSION["pp1"] = 20;
    }
}
$implement->createMap($_SESSION["ship1"], $_SESSION["ship2"]);
?>

    <div style="color: white; margin-left: 5%; font-size: 19" > Player 1 won
        <?php
        if ($_COOKIE[$_SESSION["player1"]])
            echo  $_COOKIE[$_SESSION["player1"]];
        else
            echo '0'?> times.
        <br>
        Player 2 won
        <?php
        if ($_COOKIE[$_SESSION["player2"]])
            echo  $_COOKIE[$_SESSION["player2"]];
        else
            echo '0'?> times.
    </div>
    <div class="wrap clearfix">
    <div class="left fl">
        <div class="left_block">
            <div>PP: <?php echo $_SESSION["pp1"]; ?></div>
            <div>HP: <?php echo $_SESSION["hp1"]; ?></div>
            <?php
            //    if (isset($_POST["player"]) && isset($_POST["dir"]))
            //        echo "<h1 style='color: blue '>Player {$_SESSION['player1']}</h1>";
            ?>
            <form action="index.php" method="POST">
                <input type="hidden" name="player" value="1">
                <input type="submit" name="dir" value="left">
                <input type="submit" name="dir" value="right">
                <input type="submit" name="dir" value="top">
                <input type="submit" name="dir" value="bottom">
                <br>
                <input type="submit" name="dir" value="attack">
            </form>
        </div>
    </div>

    <div class="right fl">
        <div class="right_block">
            <div>PP: <?php echo $_SESSION["pp2"]; ?></div>
            <div>HP: <?php echo $_SESSION["hp2"]; ?></div>
        <!--    --><?php
        //    if (isset($_POST["player0"]) && isset($_POST["dir"]))
        //        echo "<h1 style='color: red '>Player {$_SESSION['player2']}</h1>";
        //    ?>
            <form action="index.php" method="POST">
                <input type="hidden" name="player" value="2">
                <input class="action" type="submit" name="dir" value="left">
                <input class="action" type="submit" name="dir" value="right">
                <input class="action" type="submit" name="dir" value="top">
                <input class="action" type="submit" name="dir" value="bottom">
                <br>
                <input class="action" type="submit" name="dir" value="attack">
            </form>
        </div>
        </div>
    </div>

</div>
<div class="table clearfix">
    <?php echo $implement->table;?>
</div>
<div class="chat">
    <iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
    <iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
</div>
</body>

</html>