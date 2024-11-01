<?php 


namespace Base;

class adminbase{
	protected $f3;
	public $browserLang;
	public $lang;
	function __construct( $f3 ){
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
}