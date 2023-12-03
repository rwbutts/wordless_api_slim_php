<?php

namespace App\Exception;

class HandlerException extends \Exception
{
     public const CODE_200_OK = 200;
     public const CODE_204_NOCONTENT = 204;
     public const CODE_400_BADREQUEST = 400;
     public const CODE_401_UNAUTHORIZED = 401;
     public const CODE_403_FORBIDDEN = 403;
     public const CODE_500_INTERNALERROR = 500;
     public const DEFAULT_REASON = 'Internal server error';

     private int $httpCode;
     public function getHttpCode(){ return $this->httpCode; }

     private string $httpReasonPhrase;
     public function getHttpReasonPhrase(){ return $this->httpReasonPhrase; }

     public function __construct( string $message = null, int $httpCode = self::CODE_500_INTERNALERROR, string $httpReasonPhrase = self::DEFAULT_REASON )
     {
          parent::__construct( $message ?? $httpReasonPhrase );
          $this->httpCode = $httpCode;
          $this->httpReasonPhrase = $httpReasonPhrase;
     }
}

?>