<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpException;

class ErrorHandler 
{
     private \Slim\App $app;

     public function __construct( \Slim\App $app = null )
     {
          $this->app = $app;
     }

     public function __invoke( 
          Request  $request,
          \Throwable $exception,
          bool $displayErrorDetails,
          bool $logErrors,
          bool $logErrorDetails,
          ?LoggerInterface $logger = null
     )
     {
          $payload = [];

          if( $exception instanceof HttpException )
          {
               $code = $exception->getCode();
               $payload['description'] = $exception->getDescription();
               $reasonPhrase = $exception->getMessage();
          }
          else
          {
               $reasonPhrase = 'internal server error: ' .  $exception->getMessage();
               $code = 500;
          }

          $payload =  [ 'error' => $reasonPhrase, 'code' => $code, ];

          if ( $logErrors && $logger ) 
          {
               $logErrorDetails 
                    ? $logger->error( $exception->__toString() )
                    : $logger->error( $exception->getMessage() );
               }
       
          if( $displayErrorDetails )
          {
               $payload['details'] = $exception->__toString();
          }
       
          $response = $this->app
               ->getResponseFactory()
               ->createResponse()
               ->withStatus( $code, $reasonPhrase )
               ->withHeader( 'Content-Type', 'application/json' );

          $response->getBody()->write(
               json_encode($payload, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
          );
       
          return $response;
     }
}

?>