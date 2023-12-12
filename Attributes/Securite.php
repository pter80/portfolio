<?php



#[Attribute]
class Securite {
    
    private $data1;
    private $data2;
    
    
    
    function __construct($data1,$data2) {
        echo "Admin construct";
        $this->data1=$data1;
        $this->data2=$data2;
        
    }
    
    function test() {
        echo $this->data1;
    }
    function checkAdmin() {
        if ($this->data1="Connected") echo "Connected";
        if ($_SESSION['logged']) {
            echo "logged";die;
        }
        else {
            echo "not logged";die;
        }
    }
}