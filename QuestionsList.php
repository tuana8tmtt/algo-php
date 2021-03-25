<?php

class QuestionsList
{
    public $questions = [];
    public function get($pathMd)
    {
        $file = file_get_contents($pathMd);
        $TempExplodeQues = $this->getStringBetween($file, '######');
        for ($x = 1; $x < count($TempExplodeQues); $x++) {
            $tempQues = str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $TempExplodeQues[$x]);
            $explodeQues = $this->getStringBetween($tempQues, "Đáp án");
            $question = new Question($explodeQues[0], $explodeQues[2]);
            array_push($this->questions, $question);
        }
        return $this->questions;
    }
    public function show()
    {
        return $this->questions;
    }
    function getStringBetween($string, $start){
        $regex = $display = explode($start, $string);
        return $regex;
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