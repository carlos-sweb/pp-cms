<?php

class Admin extends CtlBase{
    function  __construct(){
        parent::__construct();
    }
    public function login(){
        $f3 = Base::instance();
        


        if( $f3->exists("DB.error.code") && $f3->exists("DB.error.message") ){
            try{  
                $f3->set("MyData",[
                    "name" => "Carlos",
                    "age" => 30
                ]);
                
                $data = Config::get("data");
                 
                
              
                
                
                //Example::instance()->show();

                $this->render("install.htm");
                // $this->renderPug($f3,"install.html");
                // $this->renderLatte($f3,"install");
            }catch(Exception $e){
                echo "Error";
            }
            
        }else{
            $this->render("login.htm" );
        }        
    }
    public function logout(){
        echo "logout";
    }    
}