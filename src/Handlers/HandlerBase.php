<?php
namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Config\Config;

abstract class HandlerBase
{
     const HTTP_VER_HEADER = "X-WordlessAPI-Version";
     const VERSION_SETTING = "api_version";

     public function __invoke( Request $request, Response $response, array $args  )
     {
          $handlerResponse = $this->handle( $request, $response, $args );
          return  self::appendVersionResponseHeader( $handlerResponse );
     }

     public abstract function handle( Request $request, Response $response, array $args ) : Response;

     private function createResponse( ) : Response
     {
          $factory = \Slim\Factory\AppFactory::determineResponseFactory();
          return $factory->createResponse();
     }

     protected function JsonResponse( array|object $data ) : Response
     {
          $response = $this->createResponse()->withHeader('Content-Type', 'application/json');
          $response->getBody()->write( \json_encode( $data, JSON_THROW_ON_ERROR));
          return $response;
     }

     public static function appendVersionResponseHeader( Response $response ) : Response
     {
          return  Config::hasSetting( self::VERSION_SETTING ) 
                     ? $response->withHeader( self::HTTP_VER_HEADER, Config::getSetting( self::VERSION_SETTING ) )
                     : $response;
     }

}

?>