<?php

abstract class House {
	public function introduce() {
		if (method_exists($this, 'getHouseName')) {
			print("House ".$this->getHouseName());
		}
		if (method_exists($this, 'getHouseSeat')) {
			print(" of ".$this->getHouseSeat());
		}
		if (method_exists($this, 'getHouseMotto')) {
			print(" : \"".$this->getHouseMotto()."\"\n");
		}
	}
	abstract public function getHouseName();
	abstract public function getHouseSeat();
	abstract public function getHouseMotto();
}

?>