<?php
	class Color
	{
		public $red;
		public $green;
		public $blue;
		static $verbose = false;

		public function __construct($color)
		{
			if (isset($color['red']) && isset($color['green']) && isset($color['blue']))
			{
				$this->red = intval($color['red']);
				$this->green = intval($color['green']);
				$this->blue = intval($color['blue']);
			} else if (isset($color['rgb']))
			{
				$this->red = intval(($color['rgb'] >> 16) & 255);
				$this->green = intval(($color['rgb'] >> 8) & 255);
				$this->blue = intval($color['rgb'] & 255);
			}
			if (self::$verbose)
			{
				printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
			}
		}
		public function __destruct()
		{
			if (self::$verbose)
				printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
		}
		public function add($new)
		{
			return (new Color(array('red' => $this->red + $new->red, 'green' => $this->green + $new->green, 'blue' => $this->blue + $new->blue)));
		}
		public function sub($new)
		{
			return (new Color(array('red' => $this->red - $new->red, 'green' => $this->green - $new->green, 'blue' => $this->blue - $new->blue)));
		}
		public function mult($mult)
		{
			return (new Color(array('red' => $this->red * $mult, 'green' => $this->green * $mult, 'blue' => $this->blue * $mult)));
		}
		function __toString()
        {
            return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )", array($this->red, $this->green, $this->blue)));
        }
		public static function doc()
        {
            $read = fopen("Color.doc.txt", 'r');
            echo "\n";
            while ($read && !feof($read))
                echo fgets($read);
            echo "\n";
        }
	}
?>
