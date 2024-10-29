<?php

class PublicWWW extends CtlBase{
    function __construct(){ parent::__construct();}
    public function index(){
        $f3 = Base::instance();        
        echo $this->render( "public/index.htm" , false );
    } 
}