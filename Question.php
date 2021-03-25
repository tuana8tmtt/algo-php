<?php

class Question
{
    public $parsed;
    public $content;
    public $answer;
    public function __construct($content = null, $answer = null)
    {
        $this->content = $content;
        $this->answer = $answer;
    }
    public function get($pathMd, int $numQue = 0)
    {

        $file = file_get_contents($pathMd);
        $this->parsed = $this->getStringBetween($file, '######');
        if ($numQue > 0) {
            $temQues = str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $this->parsed[$numQue]);

            $explodeQues = $this->getStringBetween($temQues, 'Đáp án');
            $this->content = $explodeQues[0];
            $this->answer = $explodeQues[2];
        }
    }
    function getStringBetween($string, $start){
        $regex = explode($start, $string);
        return $regex;
    }

}

?>