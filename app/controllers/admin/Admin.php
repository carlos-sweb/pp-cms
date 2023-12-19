<?php
class Admin extends CtlBase{
    function  __construct($f3){
        parent::__construct($f3);
    }
    public function login($f3){
        //$this->render($f3 , "login.htm" );
        $this->render($f3,"install.htm");
    }
    public function logout(){
        echo "logout";
    }
}