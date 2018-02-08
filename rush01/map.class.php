<?php

class map {
    const WIDTH = 150;
    const HEIGHT = 100;
    public $x;
    public $y;

    static function doc()
    {
        print (file_get_contents('Map.doc.txt') . PHP_EOL);
    }

    public function createMap($ship1, $ship2)
    {

        $table = '<table>';
        for ($x = 0; $x < self::HEIGHT; $x++) {
            $table .= '<tr>';
            for ($y = 0; $y < self::WIDTH; $y++) {
                if ($x == $ship1[0] && $y == $ship1[1])
                    $table .= '<td data-x="'.$x.'" data-y="'.$y.'" style="color: blue; background: blue">X</td>';
                else if ($x == $ship2[0] && $y == $ship2[1])
                    $table .= '<td data-x="'.$x.'" data-y="'.$y.'" style="color: red; background: red">X</td>';
                else if (array_key_exists($x, $_SESSION["rocks"]) && $y == ($_SESSION["rocks"][$x]))
                    $table .= '<td data-x="'.$x.'" data-y="'.$y.'" style="color: white; border-radius: 50%; animation: NAME-YOUR-ANIMATION 1s infinite; background: white"></td>';
                else
                    $table .= '<td data-x="'.$x.'" data-y="'.$y.'"></td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';
        $this->table = $table;
    }
}
?>

<html>
<head>
    <style>
    @-webkit-keyframes NAME-YOUR-ANIMATION {
        0%, 49% {
            background-color: rgb(63, 87, 124);
            border-radius: 50%;
            border: 1px solid rgba(63, 87, 124, .5);
        }
        50%, 100% {
            background-color: white;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .5);
        }
    }
    </style>

    </head>

        </html>


