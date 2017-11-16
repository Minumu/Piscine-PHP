<?php

	require_once 'Vertex.class.php';

	class Vector
	{
		private $_x;
		private $_y;
		private $_z;
		private $_w = 0.0;
		static $verbose = false;

		public function __construct($arr)
		{
			if (isset($arr['dest'])) {
				if (isset($arr['orig'])) {
					$orig = new Vertex(array('x' => $arr['orig']->getX(), 'y' => $arr['orig']->getY(), 
						'z' => $arr['orig']->getZ(), 'w' => $arr['orig']->getW()));
				}
				else {
					$orig = new Vertex(array('x' => 0, 'y' => 0, 
						'z' => 0, 'w' => 1));
				}
				$this->_x = $arr['dest']->getX() - $orig->getX();
                $this->_y = $arr['dest']->getY() - $orig->getY();
                $this->_z = $arr['dest']->getZ() - $orig->getZ();
                $this->_w = $arr['dest']->getW() - $orig->getW();
			}
			if (self::$verbose)
                printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
		}
		public function __destruct()
		{
			if (self::$verbose) {
				printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
			}
		}
		function __toString()
        {
            return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }
        public function magnitude() {
        	return (float)(sqrt(($this->getX() * $this->getX()) + ($this->getY() * $this->getY()) + ($this->getZ() * $this->getZ())));
        }
        public function normalize() {
        	$normal = $this->magnitude();
        	if ($normal > 1)
        		return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() / $normal, 'y' => $this->getY() / $normal, 'z' => $this->getZ() / $normal)))));
        	else 
        		return clone $this;
        }
        public function add (Vector $rhs) {
        	return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() + $rhs->getX(), 'y' => $this->getY() + $rhs->getY(), 'z' => $this->getZ() + $rhs->getZ())))));
        }
        public function sub (Vector $rhs) {
        	return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() - $rhs->getX(), 'y' => $this->getY() - $rhs->getY(), 'z' => $this->getZ() - $rhs->getZ())))));
        }
        public function opposite () {
        	return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() * -1, 'y' => $this->getY() * -1, 'z' => $this->getZ() * -1)))));
        }
        public function scalarProduct ($k) {
        	return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() * $k, 'y' => $this->getY() * $k, 'z' => $this->getZ() * $k)))));
        }
        public function dotProduct (Vector $rhs) {
        	return (float)($this->getX() * $rhs->getX()) + ($this->getY() * $rhs->getY()) + ($this->getZ() * $rhs->getZ());
        }
        public function cos(Vector $rhs) {
        	return (float)($this->dotProduct($rhs) / ($this->magnitude() * (sqrt(($rhs->getX() * $rhs->getX()) + ($rhs->getY() * $rhs->getY()) + ($rhs->getZ() * $rhs->getZ())))));
        }
        public function crossProduct(Vector $rhs) {
        	return (new Vector(array('dest' => new Vertex(array(
                'x' => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
                'y' => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
                'z' => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX()
            )))));
        }
		public function getX() {
        	return $this->_x;
        }
         public function getY() {
        	return $this->_y;
        }
         public function getZ() {
        	return $this->_z;
        }
         public function getW() {
        	return $this->_w;
        }
        public static function doc()
        {
            $read = fopen("Vector.doc.txt", 'r');
            echo "\n";
            while ($read && !feof($read))
                echo fgets($read);
            echo "\n";
        }
	}
?>