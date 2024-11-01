<?php


namespace Admin;
use Base\adminbase;

class admin extends adminbase{
    protected $f3;
    function __construct( $f3 ){     
       parent::__construct( $f3 );
    }
    
    public function index( $f3 ){        
        $lang = $f3->get("SESSION.language");
        
        //$page = $f3->exists("PARAMS.page") ? $f3->get('PARAMS.page') : "login";
        //ppCMSconfig::loadConfigView($page);
        //echo $this->render( "admin/".$page );
        
        /*
        $user = new User();        
        $auth = new Auth($user,array(
            "id" => "mail",
            "pw" => "pwd"
        ));        
        */
       // echo  Bcrypt::instance()->hash( "Montenegro." , $f3->get("hash") ); 
        /*  
        $password = "clave";
        $pwd = Bcrypt::instance()->hash( $password , $f3->get("hash") );
        $login = $auth->login("c4rl0sill3sc4@gmail.com",$pwd);

        if( $login ){
            echo "Se puedo<br>";
            echo $f3->CSRF;
            echo "<br>";
            echo $sess->agent()."<br>";
            echo $sess->csrf()."<br>";
            echo $sess->ip()."<br>";
            echo "<pre>";
            //$f3->set("SESSION.test","123");
            $f3->copy("CSRF","SESSION.csrf");
            print_r($f3->get("SESSION"));
        }else{
            echo $pwd."<br>";
            echo "No eres";
        }
        */
        //echo $this->render("admin/".$page);
    }
    public function logout(){
        echo "logout";
    }
}      