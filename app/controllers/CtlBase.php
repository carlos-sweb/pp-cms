<?php
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;


class CtlBase extends \Prefab{
    protected $dd; // Device Detector
    protected $f3;
    public $filesystem;    
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

    function  __construct(){

        $f3 = Base::instance();                        
        // The internal adapter
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter( __DIR__."/../dict/views/" );
        // The FilesystemOperator
        $this->filesystem = new League\Flysystem\Filesystem($adapter);
            
        $language = $f3->exists("PARAMS.language") ? $f3->get("PARAMS.language") : "en";

        //Cache::instance()->set("lang",$language);

        $page = $f3->get("PARAMS.page");

        // $f3->set("SESSION.language",$language);
        
        
        
        /*
        if( !$f3->exists("SESSION.csrf") && !$f3->exists("SESSION.csrf_active") ){
            $f3->set("SESSION.csrf",$f3->get("CSRF"));
            $f3->set("SESSION.csrf_active",true);      
        }else{
            if( !$f3->get("SESSION.csrf_active") ){
                $f3->set("SESSION.csrf",$f3->get("CSRF"));
                $f3->set("SESSION.csrf_active",true);  
            }
        }*/
        
        // $f3->set("access",Access::instance());                
        //$f3->get("access")->deny("/api*","public");


        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
        $userAgent = $f3->get("SERVER.HTTP_USER_AGENT"); // change this to the useragent 
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional
        $this->dd = new DeviceDetector($userAgent, $clientHints);
        $this->dd->parse();





        
        // $f3->set("dd",$dd);
        
    }

    

    private function checkFormCsrf(){}

    private function isLoggin(){
        $f3 = \Base::instance();
        return $f3->exists("SESSION.ID") && $f3->exists("SESSION.name");
    }
    public function minify($html) {
        // Eliminar espacios en blanco y saltos de línea entre las etiquetas
        $html = preg_replace('/\s+/', ' ', $html);    
        // Eliminar espacios en blanco antes y después de las etiquetas
        $html = preg_replace('/\s*<\s*/', '<', $html);
        $html = preg_replace('/\s*>\s*/', '>', $html);    
        return $html;
    }    
    public function render( $content , $minify = true ){
    
        $fw = Base::instance();        
        $fw->set("js",$this->js_list);

        $fw->set("content",$content);
        $html = \Template::instance()->render("template.htm","text/html");

        return $minify ? $this->minify($html) : $html;
        
        
        
    }
    

    

    
}