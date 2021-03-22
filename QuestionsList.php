<?php

class QuestionsList
{
    public $questions = [];
    public $dataMd;
    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
    public function parse($Path)
    {
        $contents = file_get_contents($Path);
        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $this->dataMd = $Parsedown->text($contents);
    }
    public function saveQuestions($pathSave, $data)
    {
        $myfile = fopen($pathSave, "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($data, JSON_PRETTY_PRINT),);
        fclose($myfile);
    }

    public function getQuestions($pathMd, $pathSave)
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
        $this->saveQuestions($pathSave, $this->questions);

    }
    public function showAllQues($pathSave)
    {
        $lines = file($pathSave);

        foreach($lines as $line){
            echo $line."</br>";
        }
    }
    public function fuzzySearch($searchKey)
    {
        $tempSearch = [];
        $content = json_decode(file_get_contents("questions.json"), JSON_PRETTY_PRINT);
        foreach ($content as $key => $val) {
            if (strpos($val['content'], $searchKey) != false) {
                array_push($tempSearch,$content[$key]);
            }
        }
        return $tempSearch;
    }
}