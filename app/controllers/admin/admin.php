<?php
namespace Admin;
use Base\adminbase;

class admin extends adminbase{
    protected $f3;
        protected $js_list = [
        '/node_modules/lucide/dist/umd/lucide.min.js',
        '/node_modules/pp-is/dist/pp-is.min.js',
        '/node_modules/pp-events/dist/pp-events.min.js',
        '/node_modules/pp-validate/pp-validate.min.js',
        '/node_modules/pp-model.js/pp-model.min.js',
        '/node_modules/pp-element/pp-element.min.js',
        '/node_modules/pp-router.js/pp-router.js',
        '/node_modules/axios/dist/axios.min.js',
    ];
    function __construct( $f3 ){     
       parent::__construct( $f3 );
    }
    
    public function index( $f3 ){        
        $lang = $f3->get("SESSION.language");
        
        //$page = $f3->exists("PARAMS.page") ? $f3->get('PARAMS.page') : "login";
        //ppCMSconfig::loadConfigView( $f3, "login");
        $f3->config("./../app/views/admin/login/config.ini");
        $f3->set("js",$this->js_list);
        echo $this->render( $f3 , "admin/login" , false );
        
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