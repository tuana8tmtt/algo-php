<?php

class Question
{
    public $parsed;
    public $content;
    public $answer;

    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }

    public function getQuestion($pathMd, int $numQue = 0)
    {

        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $this->parsed = $forExplode->getStringBetween($file, '######');
        if ($numQue > 0) {
            $tempQues = $this->removeTag($this->parsed[$numQue]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
            $this->content = $explodeQues[0];
            $this->answer = $explodeQues[2];
        }
    }

}

?>