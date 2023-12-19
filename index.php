<?php
require "vendor/autoload.php";
$f3 = \Base::instance();
$options = array(
  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// generic attribute
  \PDO::ATTR_PERSISTENT => TRUE,// we want to use persistent connections
  \PDO::MYSQL_ATTR_COMPRESS => TRUE,// MySQL-specific attribute
);
try{
    $db = new \DB\SQL('mysql:host=localhost;port=3306;dbname=ppcms','root','c4rl0sill', $options);
}catch( PDOException $e){
    $f3->set("DB.error.code",$e->getCode());
    $f3->set("DB.error.message",$e->getMessage());            
}
$cache=Cache::instance();
$sessionCache=new Cache('folder=var/session');        
$sess=new Session(NULL,"CSRF",$sessionCache);
$f3->config("config.ini");
$f3->config("routes.ini");
$f3->run();
?>