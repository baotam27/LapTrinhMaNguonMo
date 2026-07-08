<?php
namespace App\Students;

class Student extends Person {
    private $studentID;

    public function __construct($name, $age, $studentID) {
        parent::__construct($name, $age);
        $this->studentID = $studentID;
    }

    public function getInfo() {
        return "ID: " . $this->studentID . " | Name: " . $this->name . " | Age: " . $this->age;
    }
}