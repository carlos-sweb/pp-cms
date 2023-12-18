<?php


class CtlBase{
    protected $f3;
    private function isLoggin(){
        $f3 = \Base::instance();
        return $f3->exists("SESSION.ID") && $f3->exists("SESSION.name");
    }
    public function render($f3){

        $data = array(
            "title" => "pp-cms",
            "css"=>array(
                "/css/dist/master.css",
                "/fonts/Ubuntu/index.css"
            ),
            "js"=>array(                
                "/node_modules/pp-is/pp-is.min.js",
                "/node_modules/pp-events/pp-events.min.js",
                "/node_modules/pp-validate/pp-validate.min.js",
                "/node_modules/pp-model.js/pp-model.min.js",
                "/node_modules/pp-router.js/pp-router.min.js",
            ),
            "meta"=>array(
                array("name"=>"viewport","content"=>"width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0")
            ),
            "content"=>"login.htm"
        );       
        echo \Template::instance()->render("admin/template.htm","text/html",$data);
    }	
}