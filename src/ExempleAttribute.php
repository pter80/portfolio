<?php
namespace Controllers;

class ExampleAttribute {
    private string $message;
    private int $answer;
    public function __construct(string $message, int $answer) {
        $this->message = $message;
        $this->answer = $answer;
    }
}