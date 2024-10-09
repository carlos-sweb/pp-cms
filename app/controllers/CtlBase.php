<?php
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Pug\Pug;
use Symfony\Component\Yaml\Yaml;

class CtlBase extends \Prefab{
    protected $f3;
    public $filesystem;
    protected $language = ["en","es","pt"];
    protected $css_list = [
        "/node_modules/flag-icons/css/flag-icons.css",
        "/css/dist/master.css",
        "/fonts/Ubuntu/index.css"
    ];    
    protected $js_list = [
        '/node_modules/lucide/dist/umd/lucide.min.js',
        '/node_modules/pp-is/pp-is.min.js',
        '/node_modules/pp-events/pp-events.min.js',
        '/node_modules/pp-validate/pp-validate.min.js',
        '/node_modules/pp-model.js/pp-model.min.js',
        '/node_modules/pp-router.js/pp-router.min.js',
        '/node_modules/axios/dist/axios.min.js',
        '/js/install.js'
    ];

    function  __construct(){

        $f3 = Base::instance();

        if( $f3->exists("PARAMS.language") ){
            $languaje = $f3->get("PARAMS.language");
            $page = $f3->get("PARAMS.page");
            if( !in_array($languaje,$this->language) ){                
                $url_reroute = $f3->get("SERVER.REQUEST_SCHEME")."://".$f3->get("SERVER.HTTP_HOST")."/en/".$page;
                $f3->reroute($url_reroute);            
            }
        }
        
        
        // The internal adapter
        $adapter = new League\Flysystem\Local\LocalFilesystemAdapter(
            // Determine root directory
            __DIR__."/../dict/views/"
        );
        // The FilesystemOperator
        $this->filesystem = new League\Flysystem\Filesystem($adapter);
            
        $language = $f3->exists("PARAMS.language") ? $f3->get("PARAMS.language") : "en";
        $page = $f3->get("PARAMS.page");

        $f3->set("SESSION.language",$language);
        
        $this->getLocale( $f3 , 'admin/'.$language.'/'.$page);
        
                                          

        if( !$f3->exists("SESSION.csrf") && !$f3->exists("SESSION.csrf_active") ){
            $f3->set("SESSION.csrf",$f3->get("CSRF"));
            $f3->set("SESSION.csrf_active",true);      
        }else{
            if( !$f3->get("SESSION.csrf_active") ){
                $f3->set("SESSION.csrf",$f3->get("CSRF"));
                $f3->set("SESSION.csrf_active",true);  
            }
        }
        
        $f3->set("access",Access::instance());                
        //$f3->get("access")->deny("/api*","public");
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
        $userAgent = $f3->get("SERVER.HTTP_USER_AGENT"); // change this to the useragent you want to parse
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();
        // $f3->set("dd",$dd);
        
    }

    public function getLocale( $f3 , $locale ){
        
        $path = $locale.".yml";
            
        
        try {            
            if( $this->filesystem->fileExists( $path ) ){
                try {
                    $response = $this->filesystem->read( $path );                    
                    try {
                        $data = YAML::parse($response);                        
                        $f3->set("locale", json_decode(json_encode($data)) );
                    } catch (ParseException $exception) {
                        printf('Unable to parse the YAML string: %s', $exception->getMessage());
                    }
                    
                    
                } catch (FilesystemException | UnableToReadFile $exception) {
                    // handle the error
                }
            }else{
                echo "No existe ".$path;
            }
        } catch (FilesystemException | UnableToCheckExistence $exception) {
            // handle the error
        }
    }

    private function checkFormCsrf(){

    }

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
    public function render($content ){

        
        $f3 = Base::instance();    
        $f3->set("title","pp-cms");
        $f3->set("css", $this->css_list );
        $f3->set("js",$this->js_list);
        $f3->set("meta",array(
            array("name"=>"viewport","content"=>"width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0")
        ));
        $f3->set("content",$content);
        return $this->minify(\Template::instance()->render("admin/template.htm","text/html"));
        
        
    }
    public function renderLatte( $config ){        
        $f3 = Base::instance();        
        $latte = new Latte\Engine;
        $view = $f3->get("SERVER.DOCUMENT_ROOT")."/".$f3->get("UI").$config."/view.latte";
        echo $this->minify( $latte->renderToString( $view , $f3->hive() ) );
    }

    public function renderPug(){
        $f3 = Base::instance();
        $f3->set("title","Hola a todos como estan hoy");
        Phug::display('p=$title
            h1.title ha', $f3->hive() );

    }

    
}