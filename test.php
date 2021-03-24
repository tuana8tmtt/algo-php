<?php
include('parseDown.php');
require_once('ExplodeString.php');
require_once('Question.php');
require_once('QuestionsList.php');




//get, search, show all and save many questions
$questions = new QuestionsList();
$questions->get("questions.md" );
print_r($questions->show());
foreach ($questions->fuzzySearch("secret") as $key){
    echo $questions->questions[$key]->content;
    echo $questions->questions[$key]->answer.'</br>';
}

// Get and save one question
//$question = new Question("questions.md",2  );
//echo $question->content;
//print_r($question->question);


