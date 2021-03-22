<?php
class Question
{
    public $parsed;
    public $question = array();
    public $answer;
    //start method removetag
    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
    //end method removetag
    public function saveQuestions($pathSave, $data)
    {
        $myfile = fopen($pathSave, "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($data, JSON_PRETTY_PRINT),);
        fclose($myfile);
    }
    //start method save

    public function __construct($pathMd, $pathSave, int $numQue = 0)
    {

        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $this->parsed = $forExplode->getStringBetween($file, '######');
         if ($numQue>0)
        {
            $tempQues = $this->removeTag($this->parsed[$numQue]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");

            $this->question = [
                'number' => $numQue,
                'content'=> $explodeQues[0],
                'answer' => $explodeQues[2]
            ];
            $this->saveQuestions($pathSave, $this->question);
        }
    }
    //end method save
    //start method fuzzySearch

}
?>