<?php

class BalancedBracket{
    private $brackets = [
        "{" => "}",
        "(" => ")",
        "[" => "]",
    ];
    private array $allowdInput;

    private array $input;
    private $yes                = "YES";
    private $no                 = "NO";

    public function __construct(string $input)
    {
        $this->allowdInput = array_merge($this->brackets, array_keys($this->brackets));

        /**
         * Check input
         */
        $input = str_replace(" ","",$input);
        $input = str_split($input);

        foreach ($input ?? [] as $string) {
            if(!$this->inputValidator($string)) throw new Exception("Input tidak valid, karakter yang diperbolehkan ".implode(",", $this->allowdInput));
        }
        /**
         * Check input
         */

        $this->input = $input;
    }

    public function doBalancedBracket(){
        $input          = $this->input;
        $inputLength    = count($input);

        $tempBracketOpen = [];
        for ($i=0; $i < $inputLength; $i++) { 
            $bracket = $input[$i];

            if(isset($this->brackets[$bracket])){ // Bracket Open
                array_push($tempBracketOpen, $bracket);
            }elseif(in_array($bracket, $this->brackets)){ // Bracket Close
                if(empty($tempBracketOpen)) return $this->no; // Check the first bracket is close
                if($this->brackets[end($tempBracketOpen)] !== $bracket) return $this->no; // Check the value of last temp bracket from map bracket is not match with current bracket of iteration
                $tempBracketOpen = array_slice($tempBracketOpen, 0, -1); 
            }
        }

        return $this->yes;
    } 

    function inputValidator($input){
        return in_array( $input, $this->allowdInput );
    }
}

$input = trim(fgets(STDIN));

$balancedBracket = new BalancedBracket($input);
$balancedBracket = $balancedBracket->doBalancedBracket();
echo $balancedBracket;
