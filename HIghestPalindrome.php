
<?php

class HIghestPalindrome{
    private $input;

    public function __construct(string $input)
    {
        $this->input = trim(strtolower(str_replace(" ","",$input)));
    }

    function doHIghestPalindrome(){
        $string = $this->input;
        $stringArr = str_split($string);

        return join($this->replacer($stringArr));
    }

    function replacer(array $stringArr, int $replacer = 9){
        if($replacer < 0) return [-1];

        $strReplacerToPalindrome = $this->strReplacerToPalindrome($stringArr, "", $replacer);
        
        if($strReplacerToPalindrome) return $strReplacerToPalindrome;

        return $this->replacer($stringArr, $replacer - 1);
    }

    function strReplacerToPalindrome(array $stringArr, string | int $previousString, int $replacer, int $numberRecursive = 0){
        $strLength = count($stringArr);

        if($numberRecursive >= $strLength) return false;

        if($this->isPalidrome($stringArr, 0, $strLength - 1)) return $stringArr;
        
        if($numberRecursive > 0) $stringArr[$numberRecursive-1] = $previousString;

        $stringBackup                   = $stringArr[$numberRecursive];
        $stringArr[$numberRecursive]    = $replacer;

        return $this->strReplacerToPalindrome($stringArr, $stringBackup, $replacer, $numberRecursive + 1);
    }

    function isPalidrome(array $stringArr, int $ear, int $last){
        if($ear >= $last) return true;
        if((int)$stringArr[$ear] !== (int)$stringArr[$last]) return false;

        return $this->isPalidrome($stringArr, $ear + 1, $last - 1);
    }
}

$input = trim(fgets(STDIN));

$balancedBracket = new HIghestPalindrome($input);
echo $balancedBracket->doHIghestPalindrome();
