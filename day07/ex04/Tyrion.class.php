<?php

class Tyrion extends Lannister {
	public function sleepWith($who) {
		if (get_class($who) === "Jaime")
			print("Not even if I'm drunk !\n");
		if (get_class($who) === "Sansa")
			print("Let's do this.\n");
		if (get_class($who) === "Cersei")
			print("Not even if I'm drunk !\n");
	} 
}

?>