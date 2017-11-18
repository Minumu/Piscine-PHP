<?php

class Jaime extends Lannister {
	public function sleepWith($who) {
		if (get_class($who) === "Tyrion")
			print("Not even if I'm drunk !\n");
		if (get_class($who) === "Sansa")
			print("Let's do this.\n");
		if (get_class($who) === "Cersei")
			print("With pleasure, but only in a tower in Winterfell, then.\n");
	}
}

?>