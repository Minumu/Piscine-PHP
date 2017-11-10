<?php

function auth($login, $passwd) {
	if (!$login || !$passwd || !file_exists("../private/passwd"))
		return false;
	$info = unserialize(file_get_contents("../private/passwd"));
	if ($info)
	{
		foreach ($info as $elem => $el) {
			if ($el['login'] === $login &&
				$el['passwd'] === hash("sha256", $passwd))
					return true;
			}
	}
	return false;
}
	
?>