<?php

	require_once 'Color.class.php';

	class Vertex
	{
		private $_x;
		private $_y;
		private $_z;
		private $_w = 1.0;
		private $_color;
		static $verbose = false;

		public function __construct($xyzwcol)
		{
			$this->_x = $xyzwcol['x'];
			$this->_y = $xyzwcol['y'];
			$this->_z = $xyzwcol['z'];
			if (isset($xyzwcol['w'])) {
				$this->_w = $xyzwcol['w'];
			}
			if (isset($xyzwcol['color'])) {
				$this->_color = $xyzwcol['color'];
			} else {
				$this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
			}
			if (self::$verbose) {
				printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
			}
		}
		public function __destruct()
		{
			if (self::$verbose) {
				printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
			}
		}
		function __toString()
        {
            if (self::$verbose)
                return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue)));
            return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }
        public function getX() {
        	return $this->_x;
        }
        public function setX($x) {
        	$this->_x = $x;
        }
         public function getY() {
        	return $this->_y;
        }
        public function setY($y) {
        	$this->_y = $y;
        }
         public function getZ() {
        	return $this->_z;
        }
        public function setZ($z) {
        	$this->_z = $z;
        }
         public function getW() {
        	return $this->_w;
        }
        public function setW($w) {
        	$this->_w = $w;
        }
         public function getColor() {
        	return $this->_color;
        }
        public function setColor($col) {
        	$this->_color = $col;
        }
        public static function doc()
        {
            $read = fopen("Vertex.doc.txt", 'r');
            echo "\n";
            while ($read && !feof($read))
                echo fgets($read);
            echo "\n";
        }
	}
?>