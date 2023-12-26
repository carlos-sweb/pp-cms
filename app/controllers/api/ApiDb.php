<?php

class ApiDb{
    function __construct($f3){
        print_r($f3->get("GET"));    
    }
    public function  install($f3){
        print_r($f3->get("POST"));
    }
    public function get(){
        echo "get";
    }

}

