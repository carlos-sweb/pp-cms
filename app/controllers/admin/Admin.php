<?php
class Admin extends CtlBase{
    function  __construct($f3){
        parent::__construct($f3);
        
        //$language = $f3->exists("PARAMS.language") ? $f3->get("PARAMS.language") : "en";

        //$this->getLocale($f3,'/admin'.'/'.$language."/install.json");
        
        

    }
    public function login($f3){                
        if( $f3->exists("DB.error.code") && $f3->exists("DB.error.message") ){
            try{
                
                $this->render($f3,"install.htm");
                // $this->renderPug($f3,"install.html");
                // $this->renderLatte($f3,"install");
            }catch(Exception $e){
                echo "Error";
            }
            
        }else{
            $this->render($f3 , "login.htm" );
        }        
    }
    public function logout(){
        echo "logout";
    }    
}