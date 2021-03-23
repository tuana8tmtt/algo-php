<?php

class QuestionsList
{
    public $questions = [];
    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
//    public function saveQuestions($pathSave, $data)
//    {
//        $myfile = fopen($pathSave, "w") or die("Unable to open file!");
//        fwrite($myfile, json_encode($data, JSON_PRETTY_PRINT),);
//        fclose($myfile);
//    }

    public function getQuestions($pathMd)
    {
        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $TempExplodeQues = $forExplode->getStringBetween($file, '######');
        for ($x = 1; $x < count($TempExplodeQues); $x++) {
            $tempQues = $this->removeTag($TempExplodeQues[$x]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
            $arrayEachQues = [
                'number' => $x,
                'content' => $explodeQues[0],
                'answer' => $explodeQues[2]
            ];
             array_push($this->questions, $arrayEachQues);
        }
    }
    public function showAllQues()
    {
        return $this->questions;
    }
    public function fuzzySearch($searchKey)
    {
        $tempSearch = [];
        foreach ($this->questions as $key => $val) {
            if (strpos($val['content'], $searchKey) != false) {
                array_push($tempSearch,$this->questions[$key]);
            }
        }
       return $tempSearch;
    }
}