#!/usr/bin/php
<?php

echo "Enter a number: ";
while ($number = fgets(STDIN))
{
	$number = str_replace("\n", "", "$number");
	if (is_numeric($number))
	{

		if ($number % 2 == 0)
			$type = "even\n";
		else
			$type = "odd\n";
		echo "The number ".(int)$number." is ".$type;
	}	
	else
		echo "'".$number."' is not a number\n";
	echo "Enter a number: ";
}

?>
