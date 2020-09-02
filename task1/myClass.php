<?php


class myClass
{
    private $array1 = [];
    private $array2 = [];
    private $length = 20;

    public function __construct() {

        $this->array1 = self::randArray($this->length);
        $this->array2 = self::randArray($this->length);

    }
    function randArray($length, $min = 0, $max = 100) {
        return array_map(
            function() use($min, $max) {
                return rand($min, $max);
            },
            array_pad([], $length, 0)
        );
    }

    public function arraysMerge() {
        $resultArray = [];

        $i = 0;
        foreach ($this->array1 as $arr1Val) {
            $j = 0;
            array_push($resultArray, $arr1Val);
            foreach ($this->array2 as $arr2Val) {
                if ($i != $j) {
                    ++$j;
                    continue;
                }
                array_push($resultArray, $arr2Val);
                break;
            }
            ++$i;
        }

        $this->dump($this->array1);
        $this->dump($this->array2);
        $this->dump($resultArray);

        return $resultArray;
    }

    public function dump($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}