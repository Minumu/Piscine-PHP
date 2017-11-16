<?php
	class Matrix
	{
		const IDENTITY = "IDENTITY";
		const SCALE = "SCALE";
		const RX = "Ox ROTATION";
		const RY = "Oy ROTATION";
		const RZ = "Oz ROTATION";
		const TRANSLATION = "TRANSLATION";
		const PROJECTION = "PROJECTION";
		private $_preset;
		private $_scale;
		private $_angle;
		private $_vtc;
		private $_fov;
		private $_ratio;
		private $_near;
		private $_far;
		private $_matrix = array();
		static $verbose = false;

		public function __construct($arr = null) {
			if (isset($arr)) {
				if (isset($arr['preset']))
					$this->_preset = $arr['preset'];
				if (isset($arr['scale']))
					$this->_scale = $arr['scale'];
				if (isset($arr['angle']))
					$this->_angle = $arr['angle'];
				if (isset($arr['vtc']))
					$this->_vtc = $arr['vtc'];
				if (isset($arr['fov']))
					$this->_fov = $arr['fov'];
				if (isset($arr['ratio']))
					$this->_ratio = $arr['ratio'];
				if (isset($arr['near']))
					$this->_near = $arr['near'];
				if (isset($arr['far']))
					$this->_far = $arr['far'];
				$this->parse();
				$this->create_matrix();
				if (self::$verbose) {
					if ($this->_preset == self::IDENTITY)
	                	printf("Matrix ".$this->_preset." instance constructed\n");
	                else
	                	printf("Matrix ".$this->_preset." preset instance constructed\n");
				}
				$this->choose();
			}
		}
		public function __destruct() {
			if (self::$verbose)
                printf("Matrix instance destructed\n");
		}
		private function parse() {
			if (empty($this->_preset))
				return false;
			if ($this->_preset == self::SCALE && empty($this->_scale))
				return false;
			if (($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ) && empty($this->_angle))
				return false;
			if ($this->_preset == self::TRANSLATION && empty($this->_vtc))
				return false;
			if ($this->_preset == self::PROJECTION && (empty($this->_fov) || empty($this->_ratio) || empty($this->_near) || empty($this->_far)))
				return false;
		}
		private function create_matrix() {
			$i = 0;
			while ($i < 16) {
				$_matrix[$i] = 0;
				$i++;
			}
		}
		private function choose() {
			if ($this->_preset == self::IDENTITY)
				$this->identity();
			if ($this->_preset == self::TRANSLATION)
				$this->translation();
			if ($this->_preset == self::SCALE)
				$this->scale();
			if ($this->_preset == self::RX)
				$this->rotate_x();
			if ($this->_preset == self::RY)
				$this->rotate_y();
			if ($this->_preset == self::RZ)
				$this->rotate_z();
			if ($this->_preset == self::PROJECTION)
				$this->projection();
		}
		private function identity() {
			$this->_matrix[0] = 1;
			$this->_matrix[5] = 1;
			$this->_matrix[10] = 1;
			$this->_matrix[15] = 1;
		}
		private function translation() {
			$this->identity();
			$this->_matrix[3] = $this->_vtc->getX();
			$this->_matrix[7] = $this->_vtc->getY();
			$this->_matrix[11] = $this->_vtc->getZ();
		}
		private function scale() {
			$this->identity();
			$this->_matrix[0] = $this->_scale;
			$this->_matrix[5] = $this->_scale;
			$this->_matrix[10] = $this->_scale;
		}
		private function rotate_x() {
			$this->identity();
			$this->_matrix[5] = cos($this->_angle);
			$this->_matrix[6] = -sin($this->_angle);
			$this->_matrix[9] = sin($this->_angle);
			$this->_matrix[10] = cos($this->_angle);
		}
		private function rotate_y() {
			$this->identity();
			$this->_matrix[0] = cos($this->_angle);
			$this->_matrix[2] = sin($this->_angle);
			$this->_matrix[8] = -sin($this->_angle);
			$this->_matrix[10] = cos($this->_angle);
		}
		private function rotate_z() {
			$this->identity();
			$this->_matrix[0] = cos($this->_angle);
			$this->_matrix[1] = -sin($this->_angle);
			$this->_matrix[4] = sin($this->_angle);
			$this->_matrix[5] = cos($this->_angle);
		}
		private function projection() {
			$this->identity();
			$this->_matrix[5] = 1 / tan(deg2rad($this->_fov) * 0.5);
			$this->_matrix[0] = $this->_matrix[5] / $this->_ratio;
			$this->_matrix[10] = -1 * ($this->_far + $this->_near) / ($this->_far - $this->_near);
			$this->_matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
			$this->_matrix[14] = -1;
			$this->_matrix[15] = 0;
		}
		public function mult($rhs) {
			$new = array();
			for ($i = 0; $i < 16; $i += 4) {
                for ($j = 0; $j < 4; $j++) {
                    $new[$i + $j] = 0;
                    $new[$i + $j] += $this->_matrix[$i + 0] * $rhs->_matrix[$j + 0];
                    $new[$i + $j] += $this->_matrix[$i + 1] * $rhs->_matrix[$j + 4];
                    $new[$i + $j] += $this->_matrix[$i + 2] * $rhs->_matrix[$j + 8];
                    $new[$i + $j] += $this->_matrix[$i + 3] * $rhs->_matrix[$j + 12];
                }
            }
    		$mult = new Matrix();
    		$mult->_matrix = $new;
    		return ($mult);
		}
		public function transformVertex($vtx) {
			$ver = array();
			$ver['x'] = ($vtx->getX() * $this->_matrix[0]) + ($vtx->getY() * $this->_matrix[1]) + ($vtx->getZ() * $this->_matrix[2]) + ($vtx->getW() * $this->_matrix[3]);
            $ver['y'] = ($vtx->getX() * $this->_matrix[4]) + ($vtx->getY() * $this->_matrix[5]) + ($vtx->getZ() * $this->_matrix[6]) + ($vtx->getW() * $this->_matrix[7]);
            $ver['z'] = ($vtx->getX() * $this->_matrix[8]) + ($vtx->getY() * $this->_matrix[9]) + ($vtx->getZ() * $this->_matrix[10]) + ($vtx->getW() * $this->_matrix[11]);
            $ver['w'] = ($vtx->getX() * $this->_matrix[11]) + ($vtx->getY() * $this->_matrix[13]) + ($vtx->getZ() * $this->_matrix[14]) + ($vtx->getW() * $this->_matrix[15]);
            $vertex = new Vertex($ver);
            return $vertex;
		}
		function __toString()
        {
            $str = "M | vtcX | vtcY | vtcZ | vtxO\n";
            $str .= "-----------------------------\n";
            $str .= "x | %.2f | %.2f | %.2f | %.2f\n";
            $str .= "y | %.2f | %.2f | %.2f | %.2f\n";
            $str .= "z | %.2f | %.2f | %.2f | %.2f\n";
            $str .= "w | %.2f | %.2f | %.2f | %.2f";
            return (vsprintf($str, array($this->_matrix[0], $this->_matrix[1], $this->_matrix[2], $this->_matrix[3], $this->_matrix[4], $this->_matrix[5], $this->_matrix[6], $this->_matrix[7], $this->_matrix[8], $this->_matrix[9], $this->_matrix[10], $this->_matrix[11], $this->_matrix[12], $this->_matrix[13], $this->_matrix[14], $this->_matrix[15])));
        }
		public static function doc()
        {
            $read = fopen("Matrix.doc.txt", 'r');
            echo "\n";
            while ($read && !feof($read))
                echo fgets($read);
            echo "\n";
        }
	}
?>