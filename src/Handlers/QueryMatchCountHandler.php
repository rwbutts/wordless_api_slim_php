<?php
namespace App\Handlers;

use Slim\Exception\HttpBadRequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Wordless\WordUtils;
use App\Handlers\Responses\QueryMatchCountResponse;

class QueryMatchCountHandler extends HandlerBase
{
     public function handle( Request $request, Response $response, array $args ) : Response
     {
          $params = $request->getParsedBody();
          if( !is_array( $params ) || !array_key_exists( 'answer', $params ) || !array_key_exists( 'guesses', $params ) )
          {
               throw new HttpBadRequestException( request: $request, message: 'malformed QueryMatchCount request body' );
          }
     
          $count = WordUtils::CountMatches( WordUtils::WORDLIST, $params['answer'], $params['guesses'] );
          return $this->JsonResponse(new QueryMatchCountResponse( $count ));
     }

}

?>