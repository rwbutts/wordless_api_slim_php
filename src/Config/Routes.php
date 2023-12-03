<?php
namespace App\Config;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Handlers\GetWordHandler;
use App\Handlers\CheckWordHandler;
use App\Handlers\CountMatchesResponse;


return function ( \Slim\App $app )
{
     $app->options('/{routes:.*}', function ( Request $request, Response $response ) {
          // CORS Pre-Flight OPTIONS Request Handler
          return $response;
     });
          
     $app->get('/getword/{index}', GetWordHandler::class );
     
     $app->get('/checkword/{word}', CheckWordHandler::class );
     
     $app->post('/querymatchcount', CountMatchesResponse::class );
     
}
?>