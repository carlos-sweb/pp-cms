<?php

// Mirar este sistema de Cache
// https://www.scrapbook.cash/

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require __DIR__."/../vendor/autoload.php";
require __DIR__."/../lib/ppCMSconfig.php";
// looking dad
//  https://webonyx.github.io/graphql-php/getting-started/
$f3 = Base::instance();
//ppCMSconfig::instance()->loadInit();

$sessionCache = new Cache( 'folder='.__DIR__.'/../var/session' );
$sess = new Session( null , "CSRF" , $sessionCache );

$ini_files = ["globals","routes","site","db"];

foreach( $ini_files as $ini ){
    $f3->config("./../app/config/".$ini.".ini");
}


$db = new DB\SQL('mysql:host=localhost;port=3306;dbname=ppcms','root','C4rl0sim');

$f3->set("DB",$db);


$f3->run();
/*
curl 'http://localhost/api' -H 'Accept-Encoding: gzip, deflate, br' -H 'Content-Type: application/json' -H 'Accept: application/json' -H 'Connection: keep-alive' -H 'Origin: altair://-' --data-binary '{"query":"query{echo(message:\"carlos Illesca\")}","variables":{}}' --compressed
*/
?>


