<?php 


namespace Base;

class adminbase{
	protected $f3;
	public $browserLang;
	public $lang;
	function __construct( $f3 ){
		$this->db_connect($f3);
		$session_lang = $f3->get("SESSION.language");
		if( is_null($session_lang) ){
			$this->defineLanguage( $f3 );	
		}		
	}
	public function defineLanguage( $f3 ){
		
		// lang default
		$default = $f3->get("site.language.default");
		// lang support
		$support = $f3->get("site.language.support");

		// lang from browserlang
		$browserLang = substr($f3->get('HEADERS.Accept-Language'), 0, 2);
		$lang = in_array( $browserLang , 
						( is_array($support) ? $support:[] )
					) ? $browserLang : ( is_null($default ) ? $browserLang : $default ) ;
		
		$f3->set( "SESSION.language", $lang , 3600);

	}
	public function minify($html) {
        // Eliminar espacios en blanco y saltos de línea entre las etiquetas
        $html = preg_replace('/\s+/', ' ', $html);    
        // Eliminar espacios en blanco antes y después de las etiquetas
        $html = preg_replace('/\s*<\s*/', '<', $html);
        $html = preg_replace('/\s*>\s*/', '>', $html);    
        return $html;
    }  

	public function render( $f3 , $content , $minify = true ){
                
        // $f3->set("js",$this->js_list);

        $f3->set("content",$content);
        $html = \Template::instance()->render("template.htm","text/html");
        return $minify ? $this->minify($html) : $html;        
        
    }

    private function db_connect ( $f3 ){
        
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

}