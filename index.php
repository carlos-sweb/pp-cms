<?php
require __DIR__."/vendor/autoload.php";
$path_config = __DIR__."/app/config/mariadb.php";
$config = file_exists($path_config) ? require $path_config : [ "DB_USER"=>"","DB_NAME"=>"","DB_HOST"=>"","DB_PASS"=>"","DB_PORT"=>"3306"];

putenv("DB_NAME=".$config["DB_NAME"]);
putenv("DB_USER=".$config["DB_USER"]);
putenv("DB_HOST=".$config["DB_HOST"]);
putenv("DB_PASS=".$config["DB_PASS"]);
$f3 = \Base::instance();
$cache=Cache::instance();
$sessionCache=new Cache('folder=var/session');        
$sess=new Session(NULL,"CSRF",$sessionCache);
$f3->config("config.ini",true);
$f3->config("routes.ini");
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

$f3->run();
?>