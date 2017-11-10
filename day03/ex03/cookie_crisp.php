<?php

function cookie_crisp($action, $name, $value)
{
	if ($action == 'set' && $value) {
		setcookie($name, $value, time() + 3600);
	}
	if ($action == 'get') {
		echo $_COOKIE[$name]."\n";
	}
	if ($action == 'del') {
		setcookie($name, $value, time() - 3600);
	}
}

if (isset($_GET['name']) && isset($_GET['action'])) {
	cookie_crisp($_GET['action'], $_GET['name'], $_GET['value']);
}

?>