<?php
include('parseDown.php');

class Parse{
        public $dataMd;
        public function parse($Path)
    {
        $contents = file_get_contents($Path);
        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $this->dataMd = $Parsedown->text($contents);
    }


}
$contents = new Parse();
$contents->parse("questions.md");
$contents->dataMd;
// end read file md
// start save data (questions)
class saveQuestions{
    function get_string_between($string, $start){
        $regex = $display = explode($start, $string);
        return $regex;
    }
}
class Question{
    private $parsed;
    //start method removetag
    public function removeTag($string){
       return str_replace(array('<details><summary><b>', '</b></summary>', '</p>
</details>', '<p>'), "", $string);
    }
    //end method removetag
    //start method save

    public function save($pathMd, $pathSave, int $numQue = 0)
    {

        $question = new saveQuestions();
        $file = file_get_contents($pathMd);
        $this->parsed = $question->get_string_between($file, '######');
        $myfile = fopen($pathSave, "w")or die("Unable to open file!");
        if($numQue == 0){
            for ($x = 1; $x < count($this->parsed); $x++){
                fwrite($myfile, $this->removeTag($this->parsed[$x]));
            }
        }else if ($numQue>0) {
            fwrite($myfile, $this->removeTag($this->parsed[$numQue]));
        }
        fclose($myfile);

    }
    //end method save
    //start method all
    public function all($pathMd){
        $lines = file($pathMd);

        foreach($lines as $line){
            echo $line."</br>";
        }
    }
    //end method all
    //start method fuzzySearch
    public function fuzzySearch($searchKey){
        $question = new saveQuestions();
        $file = file_get_contents("questions.md");
        $questions = $question->get_string_between($file, '######');
        for ($x =1; $x < count($questions); $x++){
            $ques = explode("####", $questions[$x]);
            if (strpos($ques[0], $searchKey) != false) {
                echo htmlspecialchars($this->removeTag($ques[0]))."</br>";
            }
        }

    }

    }

$question = new Question;
//$question->save("questions.md", "questions.txt", 0);
//$question->all("questions.txt");
$question->fuzzySearch("new Boolean(false);");
