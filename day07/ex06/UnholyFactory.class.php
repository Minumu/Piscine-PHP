<?php

class UnholyFactory {
	private $all = array();
	private $i;
	private $ind;
	public function absorb($type) {
		if (!$type->name) {
			print("(Factory can't absorb this, it's not a fighter)\n");
		}
		else if (array_search($type, $this->all) === false) {
			print("(Factory absorbed a fighter of type ".$type->name.")\n");
			$this->all[] = $type;
		} else
			print("(Factory already absorbed a fighter of type ".$type->name.")\n");
	}
	private function search($request) {
		
	}
	public function fabricate($request) {
		$ind = false;
		$i = 0;
		foreach ($this->all as $elem) {
			if ($elem->name === $request) {
				$ind = true;
				break;
			}
			$i++;
		}
		if ($ind !== false) {
			print("(Factory fabricates a fighter of type ".$request.")\n");
			return ($this->all[$i]);
		} else {
			print("(Factory hasn't absorbed any fighter of type ".$request.")\n");
			return (null);
		}
	}

}

?>