<?php
namespace App;

class Card {

 //declare property

  public $test = "autoload test";

  function __construct($question, $answer) {
    $this->question = $question;
    $this->answer = $answer;
    $this->date = new \DateTime();
  }

  // déclaration des méthodes
  public function dumpQuestion() {
    echo $this->question;
  }
}