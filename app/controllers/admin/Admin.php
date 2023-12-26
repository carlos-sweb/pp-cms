<?php
class Admin extends CtlBase{
    function  __construct($f3){
        parent::__construct($f3);
    }
    public function login($f3){                
        if( $f3->exists("DB.error.code") && $f3->exists("DB.error.message") ){
            $this->render($f3,"install.htm");
        }else{
            $this->render($f3 , "login.htm" );
        }        
    }
    public function logout(){
        echo "logout";
    }    
}