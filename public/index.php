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
$f3 = Base::instance();
//ppCMSconfig::instance()->loadInit();

$sessionCache = new Cache( 'folder='.__DIR__.'/../var/session' );
$sess = new Session( null , "CSRF" , $sessionCache );
$f3->config("./../app/config/globals.ini");
$f3->config("./../app/config/routes.ini");
$f3->config("./../app/config/site.ini");
$f3->run();



// $f3->set("COOKIE.theme","dark",60);
//$cache->set("theme","dark");

/*
try{
    $logger = new Log("error.txt");
    $logger->write( "Hola" , "r" );    
}catch( Exception $e ){
    echo "<h1>Error</h1>";
}
*/

//$f3->set("db",new \DB\SQL('sqlite:'.__DIR__.'/../db.sqlite'));
// $f3->redirect('GET|POST /', $url_reroute );
// $f3->route('GET|POST /','PublicWWW->index');


/*
$f3->route('GET|POST /api',function(){
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
*/
// Solo funciona si estas dentro de la carpeta public
//$f3->route("GET /hola [cli]","Cli->index");

/*
curl 'http://localhost/api' -H 'Accept-Encoding: gzip, deflate, br' -H 'Content-Type: application/json' -H 'Accept: application/json' -H 'Connection: keep-alive' -H 'Origin: altair://-' --data-binary '{"query":"query{echo(message:\"carlos Illesca\")}","variables":{}}' --compressed
*/
?>


