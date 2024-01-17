<?php

class Admin extends CtlBase{
    function __construct(){ parent::__construct();}
    public function index(){
        $f3 = Base::instance();        
        Config::getConfigView('admin/install');
        if( $f3->get('engine') == 'latte' ){ $this->renderLatte('admin/install'); }
    }
    public function logout(){
        echo "logout";
    }
}


/*

if( $f3->exists("DB.error.code") && $f3->exists("DB.error.message") ){
            try{  
                $f3->set("MyData",[
                    "name" => "Carlos",
                    "age" => 30
                ]);
                
                // $data = Config::get("data");                                                    
                $this->renderPug($f3,"install.html");
                
            }catch(Exception $e){
                echo "Error";
            }
            
        }else{
            $this->render("login.htm" );
        } 

*/        