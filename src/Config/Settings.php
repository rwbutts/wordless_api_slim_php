<?php

use App\Handlers\GetWordHandler;
use App\Handlers\CheckWordHandler;
use App\Handlers\QueryMatchCountHandler;


return [ 
        'api_version' => '1.1.0',
        'routes'  => function ( \Slim\App $app ) {
                    // $app->options('/{routes:.*}', function ( Request $request, Response $response ) {
                    //      // CORS Pre-Flight OPTIONS Request Handler
                    //      return $response;
                    // });
                        
                    $app->get('/getword/{index}', GetWordHandler::class );
                    
                    $app->get('/checkword/{word}', CheckWordHandler::class );
                    
                    $app->post('/querymatchcount', QueryMatchCountHandler::class );
                },

        ];

?>