<?php
require "vendor/autoload.php";

$cache=Cache::instance(); // Default cache (the one defined by the CACHE variable)
$sessionCache=new Cache('folder=var/session'); // Session cache
new Session(NULL,"CSRF",$sessionCache);

$f3 = \Base::instance();

function hello(){
    echo ".";
}
$f3->config("config.ini");
$f3->config("routes.ini");
$f3->run();

?>