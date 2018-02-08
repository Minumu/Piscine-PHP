<?php

session_start();

if (empty($_POST["login1"]) || empty($_POST["passwd1"]) ||empty($_POST["login2"]) || empty($_POST["passwd2"]) || empty($_POST["submit"])
    || $_POST["login1"] == $_POST["login2"])
{
    header("location: ./register.php");
    exit();

}

require_once "connect_db.php";

$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$hash1 = hash('whirlpool', $_POST["passwd1"]);
$hash2 = hash('whirlpool', $_POST["passwd2"]);

try {
    $sql = "SELECT COUNT(*) FROM rush WHERE `login` = :login1 AND `password` = :pass1";
    $result = $pdo->prepare($sql);
    $result->bindValue(":login1", $_POST['login1']);
    $result->bindValue(":pass1", $hash1);
    $result->execute();

    $sql1 = "SELECT COUNT(*) FROM rush WHERE `login` = :login2 AND `password` = :pass2";
    $result1 = $pdo->prepare($sql1);
    $result1->bindValue(":login2", $_POST['login2']);
    $result1->bindValue(":pass2", $hash2);
    $result1->execute();

//    if (!$result->fetchColumn() || !$result1->fetchColumn())
//    {
        //header("location: ./register.php");
        //exit();
//    }
} catch (PDOException $e) {
    header("location: ./error.html");
    exit();
}

$_SESSION["logged"] = true;
$_SESSION["player1"] = $_POST['login1'];
$_SESSION["player2"] = $_POST['login2'];
header("location: ./index.php");