<?php
namespace Api;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;


/* Modelos */

use Gadgets\iPad;
use Users\Usersmapper;


class Api{    
    function __construct(){            
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");        
    }
    public function welcome( $f3 ){  

        $userAgent = $f3->get("HEADERS.User-Agent");            
        $clientHints = ClientHints::factory($_SERVER);
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();

        /*

select 
    browsers_dd.id as browser_id , 
    os_dd.id as os_id , 
    engines_dd.id as engine_id  
        from 
    browsers_dd , os_dd  , engines_dd
        where 
    browsers_dd.browser = "Chrome" 
       and 
    os_dd.os = "GNU/Linux" 
       and    
    engines_dd.engine = "Blink";

        */
        
        print_r($dd->getClient());
        print_r($dd->getClient("type"));
        print_r($dd->getClient("name"));
        print_r($dd->getClient("engine"));


        echo "\n\n";
        print_r($dd->getOs());
        print_r($dd->getDeviceName());

        //print_r($dd->getBrandName());
        //print_r($dd->getModel());


        //echo json_encode( array("version"=>"1.0.0","status"=>"live", JSON_THROW_ON_ERROR ); 
        
    }

    public function index($f3){   

        

        
        $userType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'logout' => [
                    'type'=>Type::nonNull(Type::boolean()),
                    'args'=>[
                        'token'=> Type::nonNull(Type::string())
                    ],
                    'resolve'=>function(){
                        return true;
                    }
                ],
                'login' => [
                    'type'=>Type::nonNull(Type::string()),
                    'args' => [
                        'email'=> Type::nonNull(Type::string()),
                        'password'=>Type::nonNull(type::string())
                    ],
                    'resolve' => function($rootValue, array $args){
                        
                      $user = new Usersmapper();
                      $isLoggin = $user->login( $args["email"] ,  $args["password"] );

                       if( $isLoggin ){
                         // Create session token creasy
                       } 

                       // return $isLoggin;

                       $client = new Client();
                       $sessionID =  $client->generateId($size = 22, $mode = Client::MODE_DYNAMIC);

                       return $sessionID;


                       

                        //return "login !!!!!".$args["email"];
                    }
                ]                
            ]
        ]);

        $schema = new Schema(['query' => $userType]);
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;

        try {
            
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query , $f3, null, $variableValues);
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
        
        echo json_encode($output, JSON_THROW_ON_ERROR);
    }
}