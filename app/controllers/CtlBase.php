<?php
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;


class CtlBase extends \Prefab{
    protected $dd; // Device Detector    
    protected $browserLang;
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

    private function db_connect (){

        $f3 = Base::instance();

        $options = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// generic attribute
            \PDO::ATTR_PERSISTENT => TRUE,// we want to use persistent connections
            \PDO::MYSQL_ATTR_COMPRESS => TRUE,// MySQL-specific attribute
        );

        try{
        // Creando la conexion.    
            $db = new \DB\SQL( $f3->get('db.driver').':host='.$f3->get('db.host').';port=3306;dbname='.$f3->get('db.dbname').';charset=utf8',$f3->get('db.user'),$f3->get('db.pwd') , $options );            
            
        }catch( PDOException $e ){
            $f3->set( "DB.error.code" , $e->getCode() );
            $f3->set( "DB.error.message" , $e->getMessage() );            
        }

        if( !is_null($db) ){ 
            $f3->set("DB",$db);
        }
    }

    function  __construct(  ){

        self::db_connect();        
        $f3     = Base::instance();
        $cache  = Cache::instance();        
        $str_td = "site.theme.default";
        $site_theme_default = $f3->exists( $str_td ) ? $f3->get( $str_td ) : null ;
        // Abreviación del string theme support
        $str_ts = "site.theme.support";
        $site_theme_support = $f3->exists( $str_ts ) ? 
            $f3->get( $str_ts ) 
            : null ;
                

        


        $this->browserLang = substr($f3->get('HEADERS.Accept-Language'), 0, 2);
        // The internal adapter
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter( __DIR__."/../dict/views/" );
        // The FilesystemOperator
        $this->filesystem = new League\Flysystem\Filesystem($adapter);
            
        $language = $f3->exists("PARAMS.language") ? $f3->get("PARAMS.language") : "en";        
        $page = $f3->get("PARAMS.page");
        // $f3->set("access",Access::instance());                
        //$f3->get("access")->deny("/api*","public");

        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
        $userAgent = $f3->get("SERVER.HTTP_USER_AGENT"); // change this to the useragent 
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional
        $this->dd = new DeviceDetector($userAgent, $clientHints);
        $this->dd->parse();        


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
    
        $f3 = Base::instance();        
        $f3->set("js",$this->js_list);

        $f3->set("content",$content);
        $html = \Template::instance()->render("template.htm","text/html");

        return $minify ? $this->minify($html) : $html;
        
        
        
    }
    

    

    
}