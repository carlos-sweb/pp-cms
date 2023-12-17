<?php
require("vendor/autoload.php");
$fw = Base::instance();

$fw->config(__DIR__.'config.ini');

$fw->route("GET /",function($fw){
    $fw->set('name','world');
    echo \Template::instance()->render('app/views/public/index.htm');
});

$fw->route("POST /login",function($fw){ 
    $fw->reroute("/admin");
});

$fw->route("GET /admin",function($fw){ 
    echo \Template::instance()->render('app/views/admin/index.htm');
 });

$fw->set('ONERROR',
    function($fw) {
        // custom error handler code goes here
        // use this if you want to display errors in a
        // format consistent with your site's theme
        echo \Template::instance()->render('app/views/error/404.htm');
    }
);
$fw->run();

?>