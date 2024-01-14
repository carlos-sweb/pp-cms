<?php

class ApiDb{
    
    protected $data = array(
        "username" => "string",
        "database" => "string",
        "username" => "string",
        "password" => "string"        
    );

    function __construct($f3){        
        if( $f3->get("POST.csrf") == $f3->get("SESSION.csrf") ){
            
        }else{
            
        }
    

    }
    public function  install($f3){

        



    }
    public function get(){
        echo "get";
    }
}

