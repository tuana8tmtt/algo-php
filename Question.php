<?php
class Question
{
    public $parsed;
    public $questions = array();
    public $question;
    public $answer;
    //start method removetag
    public function removeTag($string)
    {
        return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
    //end method removetag
    //start method save

    public function saveQuestion($pathMd, $pathSave, int $numQue = 0)
    {

        $forExplode = new ExplodeString();
        $file = file_get_contents($pathMd);
        $this->parsed = $forExplode->getStringBetween($file, '######');
        $myfile = fopen($pathSave, "w")or die("Unable to open file!");
        if($numQue == 0)
        {
            for ($x = 1; $x < count($this->parsed); $x++)
            {
                $tempQues = $this->removeTag($this->parsed[$x]);
                $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
                $arrayEachQues = [
                    'number' => $x,
                    'content'=> $explodeQues[0],
                    'answer' => $explodeQues[2]
                ];
                array_push($this->questions, $arrayEachQues);
            }
        }else if ($numQue>0)
        {
            $tempQues = $this->removeTag($this->parsed[$numQue]);
            $explodeQues = $forExplode->getStringBetween($tempQues, "Đáp án");
            $arrayEachQues = [
                'number' => $numQue,
                'content'=> $explodeQues[0],
                'answer' => $explodeQues[2]
            ];
            array_push($this->questions, $arrayEachQues);
            //fwrite($myfile, $this->removeTag($this->parsed[$numQue]));
        }
        fwrite($myfile, json_encode($this->questions, JSON_PRETTY_PRINT), );
        fclose($myfile);
    }
    //end method save
    //start method all
    public function showAllQues($pathMd)
    {
        $lines = file($pathMd);

        foreach($lines as $line){
            echo $line."</br>";
        }
    }
    //end method all
    //start method fuzzySearch
    public function fuzzySearch($searchKey)
    {
        $content = json_decode(file_get_contents("questions.json"), JSON_PRETTY_PRINT);
        foreach ($content as $key => $val) {
            if (strpos($val['content'], $searchKey) != false) {
                return $content[$key];
            }
        }
        return null;
    }
}
?>