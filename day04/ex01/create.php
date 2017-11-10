<?php

if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK") {
	if (!file_exists("../private"))
		mkdir("../private");
	if (!file_exists("../private/passwd"))
		file_put_contents("../private/passwd", null);
	$info = unserialize(file_get_contents("../private/passwd"));
	$match = 0;
	foreach ($info as $elem => $el) {
		if ($el['login'] === $_POST['login'])
			$match = 1;
	}
	if ($match != 1) {
		$arr = array(
		'login' => $_POST['login'],
		'passwd' => hash("sha256", $_POST['passwd'])
		);
		$info[] = $arr;
		$ser = serialize($info);
		file_put_contents("../private/passwd", $ser);
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";

?>