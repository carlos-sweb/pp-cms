<?php
namespace Api;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class api{    
    function __construct(){            
        
    }
    public function welcome(){
        
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");
        echo json_encode( array("version"=>"1.0.0","status"=>"live") , JSON_THROW_ON_ERROR ); 

    }

    public function index(){                

            
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");

        $users = [
            1 =>  [
                "id" => 1 ,
                "email" => "admin@gmail.com"
            ], 
            2 => [
                "id" => 2 ,
                "email" => "cpanel@gmail.com"
            ] 
        ];

        $userType = new ObjectType([
            "name" => "User" , 
            "description" => "User from panel", 
            "fields" => [
                "id" =>[
                    "type" => Type::int() , 

                ] , 
                "email" => Type::string()
            ]
        ]);

         $queryType = new ObjectType([
            'name' => 'Query',
                'fields' => [
                    'echo' => [
                        'type' => Type::listOf( $userType ),
                        'args' => [
                            'message' => Type::nonNull(Type::string()),
                            'id' => type::nonNull(Type::int()),
                        ],
                        'resolve' => function( $rootValue , $args ){
                            
                            return [
                                ["id"=>1,"email"=>"admimn@gmail.com"],
                                ["id"=>2,"email"=>"cpanel@gmail.com"]
                            ];

                        },
                        /*
                        'resolve' => fn ($rootValue, array $args): string => $rootValue['prefix'] . $args['message'],
                        */
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
            
            $result = GraphQL::executeQuery(
                $schema, 
                $query, 
                $rootValue, 
                null, 
                $variableValues);

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
        //--------------------------------------------------------------------------------
    }
}