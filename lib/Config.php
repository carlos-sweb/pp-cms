<?php

use Symfony\Component\Yaml\Yaml;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class Config extends \Prefab{
    private static $path_config = "app/config/";
    public static function get( $config ){
        $f3 = Base::instance();     
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter(
            // Determine root directory
            $f3->get("SERVER.DOCUMENT_ROOT")
        );
        // The FilesystemOperator
        $filesystem = new League\Flysystem\Filesystem($adapter);
        $yaml = new \stdClass;
        if( $filesystem->fileExists(self::$path_config.$config.".yml")){
            $response=$filesystem->read( self::$path_config.$config.".yml");
            $yaml = YAML::parse($response);
            Base::instance()->mset($yaml );
        }        
        
        return $yaml;
    }
}

