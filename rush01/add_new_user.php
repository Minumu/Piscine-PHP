<?php
session_start();

if (empty($_POST["login1"]) || empty($_POST["passwd1"]) ||empty($_POST["login2"]) || empty($_POST["passwd2"]) || empty($_POST["submit"]) || $_POST["login1"] == $_POST["login2"])
{
    header("location: ./register.php");
    exit();
}

require_once "connect_db.php";
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $hash1 = hash('whirlpool', $_POST["passwd1"]);
    $hash2 = hash('whirlpool', $_POST["passwd2"]);
    $sql = "SELECT COUNT(*) FROM rush WHERE (`login` = :login1) OR (`login` = :login2)";
    $result = $pdo->prepare($sql);
    $result->bindValue(":login1", $_POST['login1']);
    $result->bindValue(":login2", $_POST['login2']);
    $result->execute();
    if ($result->fetchColumn())
    {
        header("location: ./register.php");
        exit();
    }
} catch (PDOException $e) {
    header("location: ./error.html");
    exit();
}

unset($sql);
unset($result);

try {
    $sql = "INSERT INTO rush (`login`, `password`, `points`) VALUES (:login1, :hash1, 0), (:login2, :hash2, 0)";
    $result = $pdo->prepare($sql);
    $result->bindValue(":login1", $_POST['login1']);
    $result->bindValue(":login2", $_POST['login2']);
    $result->bindValue(":hash1", $hash1);
    $result->bindValue(":hash2", $hash2);
    $result->execute();
    $pdo->query($sql);
} catch (PDOException $e) {
    header("location: ./error.html");
    exit();
}

$_SESSION["logged"] = true;
$_SESSION["player1"] = $_POST['login1'];
$_SESSION["player2"] = $_POST['login2'];
header("location: ./index.php");


