<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__."/../vendor/autoload.php";
require __DIR__."/../lib/Config.php";

$config = Config::instance()->get("global");

$path_config = __DIR__."/../app/config/mariadb.php";

$config = file_exists($path_config) ? require $path_config : [ "DB_USER"=>"","DB_NAME"=>"","DB_HOST"=>"","DB_PASS"=>"","DB_PORT"=>"3306"];

putenv("DB_NAME=".$config["DB_NAME"]);
putenv("DB_USER=".$config["DB_USER"]);
putenv("DB_HOST=".$config["DB_HOST"]);
putenv("DB_PASS=".$config["DB_PASS"]);
$f3 = Base::instance();
$cache=Cache::instance();
$sessionCache=new Cache('folder='.__DIR__.'/../var/session');        
$sess=new Session(NULL,"CSRF",$sessionCache);

$f3->config(__DIR__."/../config.ini",true);
$f3->config(__DIR__."/../routes.ini");

/*
$options = array(
  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// generic attribute
  \PDO::ATTR_PERSISTENT => TRUE,// we want to use persistent connections
  \PDO::MYSQL_ATTR_COMPRESS => TRUE,// MySQL-specific attribute
);

try{
    $db = new \DB\SQL('mysql:host='.$f3->get('db.HOST').';port=3306;dbname='.$f3->get('db.NAME').';charset=utf8',$f3->get('db.USER'),$f3->get('db.PASS'), $options);
}catch( PDOException $e){
    $f3->set("DB.error.code",$e->getCode());
    $f3->set("DB.error.message",$e->getMessage());            
}
    */

$url_reroute = $f3->get("SERVER.REQUEST_SCHEME")."://".$f3->get("SERVER.HTTP_HOST")."/en";
$f3->redirect('GET|POST /', $url_reroute );
$f3->route('GET|POST /','Public->index');
$f3->route('GET|POST /@language/admin/','Admin->index');
$f3->route('GET|POST /@language/admin/@page','Admin->index');



$f3->run();

?>