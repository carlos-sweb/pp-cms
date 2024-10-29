<?php

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class ppCMSconfig extends \Prefab{    

    private static $ini_config = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.ini";
    private static $ini_db = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."db.ini";
    private static $ini_site = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."site.ini";

    private static $path_config = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR;
    public static function loadInit(){
            
        $fw = Base::instance();        
        $fw->config(self::$ini_config);
        $fw->config(self::$ini_db);
        $fw->config(self::$ini_site);
        
        $options = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// generic attribute
            \PDO::ATTR_PERSISTENT => TRUE,// we want to use persistent connections
            \PDO::MYSQL_ATTR_COMPRESS => TRUE,// MySQL-specific attribute
        );
        try{
        // Creando la conexion.    
            $db = new \DB\SQL( $fw->get('db.driver').':host='.$fw->get('db.host').';port=3306;dbname='.$fw->get('db.dbname').';charset=utf8',$fw->get('db.user'),$fw->get('db.pwd') , $options );
        }catch( PDOException $e ){
            $fw->set( "DB.error.code" , $e->getCode() );
            $fw->set( "DB.error.message" , $e->getMessage() );            
        }

        

        $cache = Cache::instance();
        $cache->set( "theme" , "light" , 3600 );
        $cache->set( "language" , "en" , 3600 );                
        $sessionCache = new Cache( 'folder='.__DIR__.'/../var/session' );
        $sess = new Session( NULL , "CSRF" , $sessionCache );
        
    }
    public static function getConfigLocale( $config ){

        $f3 = Base::instance();
        $path = $f3->get("SERVER.DOCUMENT_ROOT").DIRECTORY_SEPARATOR.$f3->get("UI").DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR.$config;
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter($path);
        $filesystem = new League\Flysystem\Filesystem($adapter);
        $toml = new \stdClass; 
        if( $filesystem->fileExists("config.ini") ){        
            // $response=$filesystem->read( "config.toml");
            // $toml = \Devium\Toml\Toml::decode($response, asArray: true);
            // Base::instance()->mset($toml);        
        }else{
            $logger = new Log("view_error.log");
            $logger->write("No se encuentra el archivo toml => ". $config );
        }

    }
    public static function getConfigView( $config ){

        $fw = Base::instance();
        $path = $fw->get("SERVER.DOCUMENT_ROOT").DIRECTORY_SEPARATOR.$fw->get("UI").DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR.$config;        
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter($path);
        $filesystem = new League\Flysystem\Filesystem($adapter);
        if( $filesystem->fileExists("config.ini") ){
            $fw->config( $path."/config.ini" );        
        }
        // $logger = new Log("view_error.log");
        // $logger->write("No se encuentra el archivo toml => ". $config  );
    }
}

