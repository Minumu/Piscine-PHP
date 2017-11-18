<?php

class NightsWatch implements IFighter {
	public $fighter = array();
	public function recruit($who) {
		if ($who instanceof IFighter) {
			$this->fighter[] = $who;
		}
	}
	public function fight() {
		foreach ($this->fighter as $f)
			$f->fight();
	}
}

?>