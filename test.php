<?php
include('parseDown.php');
require_once('Parse.class.php');
require_once('Question.class.php');
require_once('saveQuestions.class.php');




$question = new Question;
$question->fuzzySearch("new Boolean(false);");
