<?php

if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK") {
	if (file_exists("../private/passwd")) {
			$info = unserialize(file_get_contents("../private/passwd"));
			if ($info)
			{
				$match = 0;
				foreach ($info as $elem => $el) {
					if ($el['login'] === $_POST['login'] &&
						$el['passwd'] === hash("sha256", $_POST['oldpw'])) {
						$match = 1;
						$change = $elem;
					}
					if ($match === 1) {
						$info[$change]['passwd']= hash("sha256", $_POST['newpw']);
                       	$ser = serialize($info);
						serialize($ser);
						file_put_contents("../private/passwd", $ser);
						echo "OK\n";
					} else
						echo "ERROR\n";
					}
            } else
			    echo "ERROR\n";
	} else
	    echo "ERROR\n";
} else
    echo "ERROR\n";

?>