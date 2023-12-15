<?php
require("vendor/autoload.php");
$fw = Base::instance();

$fw->route("GET /",function($fw){
    $fw->set('name','world');
    echo \Template::instance()->render('template.htm');
});

$fw->route("GET /login",function($fw){ 
    echo \Template::instance()->render('app/views/admin/login.htm');
});
$fw->route("POST /login",function($fw){ 
    echo "Recivido";
});

$fw->route("GET /admin",function($fw){ 
    echo \Template::instance()->render('app/views/admin/index.htm');
 });

$fw->set('ONERROR',
    function($fw) {
        // custom error handler code goes here
        // use this if you want to display errors in a
        // format consistent with your site's theme
        echo $fw->get('ERROR.text');
    }
);

$fw->run();

?>