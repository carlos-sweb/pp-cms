<?php

class Admin extends CtlBase{
    
    function __construct(){ 
        parent::__construct();
    }
    
    public function index(){
        $fw = Base::instance();                    
        $page = $fw->exists("PARAMS.page") ? $fw->get('PARAMS.page') : "login";
        ppCMSconfig::getConfigView($page);


        // echo Cache::instance()->get("theme");
        // echo "<br>";
        // echo Cache::instance()->get("language");

        // echo $this->render("admin/".$page.'/view.htm' , true );
        echo "<pre>";
        print_r($fw);
    }

    public function logout(){
        echo "logout";
    }
}      