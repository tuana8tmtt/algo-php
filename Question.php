<?php
class Question
{
    public $parsed;
    public $content;
    public $answer;

    //start method removetag
    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
    //end method removetag

    //start method save

    public function __construct($pathMd, int $numQue = 0)
    {

        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $this->parsed = $forExplode->getStringBetween($file, '######');
        if ($numQue>0)
        {
            $tempQues = $this->removeTag($this->parsed[$numQue]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
            $this->content = $explodeQues[0];
            $this->answer = $explodeQues[2];

            //$this->saveQuestions($pathSave, $this->question);
        }
    }
    //end method save
    //start method fuzzySearch

}
?>