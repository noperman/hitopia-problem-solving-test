<?php

class WeightedStrins{
    private $mapString = [
        "a" => 1,
        "b" => 2,
        "c" => 3,
        "d" => 4,
        "e" => 5,
        "f" => 6,
        "g" => 7,
        "h" => 8,
        "i" => 9,
        "j" => 10,
        "k" => 11,
        "l" => 12,
        "m" => 13,
        "n" => 14,
        "o" => 15,
        "p" => 16,
        "q" => 17,
        "r" => 18,
        "s" => 19,
        "t" => 20,
        "u" => 21,
        "v" => 22,
        "w" => 23,
        "x" => 24,
        "y" => 25,
        "z" => 26,
    ];
    private $inputString;
    private $inputQuery;
    private int $wightSum;
    private array $arrayWightDetail;
    private array $queryStatus;

    public function __construct(string $string, string $query)
    {
        $this->inputString  = $string;
        $this->inputQuery   = $query;
    }

    public function doWeightedStrings(){
        /**
         * String Weight
         */
            $inputString = $this->inputString ?? "";
            $inputString = str_split($inputString);

            $weightSum      = 0;
            $weightTemp     = 0;
            $stringTemp     = "";
            $weightArray    = [];

            foreach ($inputString ?? [] as $string) {
                $weight = $this->mapString[$string] ?? 0;

                if ($string == $stringTemp) {
                    $weightTemp = $weightTemp + $weight;
                } else {
                    $weightTemp = $weight;
                }

                $stringTemp = $string;
                $weightSum = $weightSum + $weightTemp;

                array_push($weightArray, $weightTemp);
            }
        /**
         * String Weight
         */

        /**
         * Query
         */
            $inputQuery = $this->inputQuery ?? "";
            $inputQuery = explode(",", $inputQuery);

            $arrayQuery = []; 
            foreach ($inputQuery ?? [] as $query) {
                if(in_array($query, $weightArray)) array_push($arrayQuery, "YES");
                else array_push($arrayQuery, "NO");
            }
        /**
         * Query
         */
        $this->wightSum         = $weightSum;
        $this->arrayWightDetail = $weightArray;
        $this->queryStatus      = $arrayQuery;
    }

    public function getWeightSum(){
        return $this->wightSum;
    }

    public function getArrayWightDetail(){
        return $this->arrayWightDetail;
    }

    public function getQueryStatus(){
        return $this->queryStatus;
    }
}


if ($argc > 1 && $argc < 4) {
    $input  = array_slice($argv, 1);
    $string = $input[0] ?? "";
    $query  = $input[1] ?? "";
    
    $wieghtedString = new WeightedStrins($string, $query);
    $wieghtedString->doWeightedStrings();

    echo $wieghtedString->getWeightSum()."\n";
    print_r($wieghtedString->getArrayWightDetail());
    print_r($wieghtedString->getQueryStatus());
}