<?php

class QuestionsList
{
    public $questions = [];
    public function get($pathMd)
    {
        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $TempExplodeQues = $forExplode->getStringBetween($file, '######');
        for ($x = 1; $x < count($TempExplodeQues); $x++) {
            $tempQues = str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $TempExplodeQues[$x]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
            $question = new Question($explodeQues[0], $explodeQues[2]);
            array_push($this->questions, $question);
        }
        return $this->questions;
    }
    public function show()
    {
        return $this->questions;
    }
    public function fuzzySearch($searchKey)
    {
        $tempSearch = [];
        foreach ($this->questions as $key => $val) {
            if (strpos($val->content, $searchKey) != false) {

                array_push($tempSearch,$key);
            }
        }
       return $tempSearch;
    }
}