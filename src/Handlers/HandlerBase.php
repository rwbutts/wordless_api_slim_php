<?php
namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class HandlerBase
{

     private function CreateResponse( ) : Response
     {
          $factory = \Slim\Factory\AppFactory::determineResponseFactory();
          return $factory->createResponse();
     }

     protected function JsonResponse( array|object $data ) : Response
     {
          $response = $this->CreateResponse()->withHeader('Content-Type', 'application/json');
          $response->getBody()->write( \json_encode( $data, JSON_THROW_ON_ERROR));
          return $response;
     }

}

?>