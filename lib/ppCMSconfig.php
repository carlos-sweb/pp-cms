<?php

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class ppCMSconfig extends \Prefab{    

    private static $ini_config = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.ini";
    private static $ini_db = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."db.ini";
    private static $ini_site = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."site.ini";
    private static $ini_routes = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."routes.ini";

    private static $path_config = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR;

    public static function loadInit(){
            
        $fw = Base::instance();        
        $fw->config(self::$ini_config);
        //$fw->config(self::$ini_db);
        //$fw->config(self::$ini_site);
        //$fw->config(self::$ini_routes);

 
        
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
    public static function loadConfigView( $config ){

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

