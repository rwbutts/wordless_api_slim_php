<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use App\Exception\HandlerException;


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
          $code = 500;
          $reasonPhrase = 'Unhandled exception';
          if( $exception instanceof HandlerException )
          {
               $code = $exception->getHttpCode();
               $reasonPhrase = $exception->getHttpReasonPhrase();
          }

          if ($logger) 
          {
               $logger->error($exception->getMessage());
          }
       
          $payload = ['error' => $exception->getMessage()];
          $payload['details'] = $exception->__toString();
       
          $response = $this->app
               ->getResponseFactory()
               ->createResponse()
               ->withStatus( $code, $reasonPhrase )
               ->withHeader( 'Content-Type', 'application/json' );

          $response->getBody()->write(
               json_encode($payload, JSON_UNESCAPED_UNICODE)
          );
       
           return $response;
     }
}

?>