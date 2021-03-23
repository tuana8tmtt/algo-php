<?php
include('parseDown.php');
require_once('ExplodeString.php');
require_once('Question.php');
require_once('QuestionsList.php');




//get, search, show all and save many questions
//
$questions = new QuestionsList();
$questions->getQuestions("questions.md", "questions.json" );
$questions->showAllQues();
foreach($questions->showAllQues() as $question){
    echo '<b style="font-size: 16px">'.$question['content'].'</b></br>';
    echo '<b style="font-size: 16px">'.$question['answer'].'</b></br>';
}
//print_r($questions->fuzzySearch("cool_secret"));


// Get and save one question
//$question = new Question("questions.md",2  );
//echo $question->content;
//print_r($question->question);


