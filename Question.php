<?php

class Question
{
    public $parsed;
    public $content;
    public $answer;
    public function __construct($content, $answer)
    {
        $this->content = $content;
        $this->answer = $answer;
    }
    public function get($pathMd, int $numQue = 0)
    {

        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $this->parsed = $forExplode->getStringBetween($file, '######');
        if ($numQue > 0) {
            $temQues = str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $this->parsed[$numQue]);
            $explodeQues = $display = explode($tempQues, "Đáp án");
            $this->content = $explodeQues[0];
            $this->answer = $explodeQues[2];
        }
    }

}

?>