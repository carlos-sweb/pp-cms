<?php


class Api extends CtlBase{
    function  __construct($f3){ 
        parent::__construct($f3);         
            
    }
    public function error($f3){
        echo '{"error":true,"code":2,"messague":"Method no found"}';
    }
    public function main($f3){

        $maintainer = $f3->get("PARAMS.maintainer");
        $action = $f3->get("PARAMS.action") == null ? "get" : $f3->get("PARAMS.action");
        header('Content-Type: application/json; charset=utf-8');

        
        $data = array();
        $data["get"] = $f3->get("GET");
        $data["post"] = $f3->get("POST");
        $data["maintainer"] = $maintainer;
        $data["action"] = $action;
        $data["csrf"] = $f3->get("SESSION.csrf");
        $data["language"] = $f3->get("SESSION.language");        
        $f3->set("SESSION.csrf_active",false);  
        
        echo json_encode($data);


        $ApiClassname = "Api".ucfirst($maintainer);
        if( class_exists($ApiClassname) ){
            if( method_exists($ApiClassname,$action) ){                
                $objectClass = new $ApiClassname($f3);
                call_user_func(array($objectClass,$action),$f3);
            }else{
                $this->error($f3);
            }
        }else{
            $this->error($f3);
        }                
        // ----------------------------------------------------------------
    }  
}