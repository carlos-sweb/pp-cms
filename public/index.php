<?php

// Mirar este sistema de Cache
// https://www.scrapbook.cash/

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require __DIR__."/../vendor/autoload.php";
require __DIR__."/../lib/ppCMSconfig.php";

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

// looking dad
//  https://webonyx.github.io/graphql-php/getting-started/

ppCMSconfig::instance()->loadInit();

$fw = Base::instance();


// $fw->set("COOKIE.theme","dark",60);
//$cache->set("theme","dark");

/*
try{
    $logger = new Log("error.txt");
    $logger->write( "Hola" , "r" );    
}catch( Exception $e ){
    echo "<h1>Error</h1>";
}
*/

//$fw->config(__DIR__."/../config.ini",true);
//$fw->config(__DIR__."/../routes.ini");

/*
$options = array(
  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// generic attribute
  \PDO::ATTR_PERSISTENT => TRUE,// we want to use persistent connections
  \PDO::MYSQL_ATTR_COMPRESS => TRUE,// MySQL-specific attribute
);

try{
    $db = new \DB\SQL('mysql:host='.$fw->get('db.HOST').';port=3306;dbname='.$fw->get('db.NAME').';charset=utf8',$fw->get('db.USER'),$fw->get('db.PASS'), $options);
}catch( PDOException $e){
    $fw->set("DB.error.code",$e->getCode());
    $fw->set("DB.error.message",$e->getMessage());            
}
*/

/*
$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=ppcms',
    'root',
    'C4rl0sim',    
);
$fw->set("DB",$db);
*/

//$fw->set("db",new \DB\SQL('sqlite:'.__DIR__.'/../db.sqlite'));


// $fw->redirect('GET|POST /', $url_reroute );
// $fw->route('GET|POST /','PublicWWW->index');

$fw->route('GET|POST @index: /','Admin->index');

$fw->route('GET|POST /@language/admin/','Admin->index');
$fw->route('GET|POST /@language/admin/@page','Admin->index');

$fw->route('GET|POST /api',function(){
    // ------------------------------------------------
    // Trabajar con Altair para Pruebas

        $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'echo' => [
                'type' => Type::string(),
                'args' => [
                    'message' => Type::nonNull(Type::string()),
                ],
                'resolve' => fn ($rootValue, array $args): string => $rootValue['prefix'] . $args['message'],
            ],
        ],
        ]);

        $schema = new Schema([
            'query' => $queryType
        ]);

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;

        try {
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($output, JSON_THROW_ON_ERROR);
    // ------------------------------------------------
});

// $fw->set("ONERROR","Main\Handle_error->e");

/*
$fw->set('ONERROR',
    function($fw) {
        // custom error handler code goes here
        // use this if you want to display errors in a
        // format consistent with your site's theme        
        echo $fw->get('ERROR.text');
    }
);

*/


/*
    $fw   = Base::instance();
    $db = $fw->get("DB");
    $crypt = \Bcrypt::instance();
    $pwd = $crypt->hash( "clave" ,  $fw->get("hash")  );
    
    $fw->get("DB")->exec("INSERT INTO users( mail , pwd ) VALUES ( \"c4rl0sill3sc4@gmail.com\" , \"".$pwd."\" ) ");
    */

$fw->route("GET /hola [cli]", function(){
    echo "hola a todos";
});

$fw->run();

/*

curl 'http://localhost/api' -H 'Accept-Encoding: gzip, deflate, br' -H 'Content-Type: application/json' -H 'Accept: application/json' -H 'Connection: keep-alive' -H 'Origin: altair://-' --data-binary '{"query":"query{echo(message:\"carlos Illesca\")}","variables":{}}' --compressed

*/
?>


