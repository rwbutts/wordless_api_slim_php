<?php

namespace App\Exception;


class BadRequestException extends HandlerException
{
     public const DEFAULT_REASON = 'Bad Request';

     public function __construct( string $message = null, string $httpReasonPhrase = self::DEFAULT_REASON )
     {
          parent::__construct( message: $message ?? $httpReasonPhrase, httpCode: self::CODE_400_BADREQUEST );
     }
}

?>