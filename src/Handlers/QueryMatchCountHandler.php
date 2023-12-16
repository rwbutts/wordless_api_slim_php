<?php
namespace App\Handlers;

use App\Exception\BadRequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Wordless\WordUtils;
use App\Handlers\Responses\QueryMatchCountResponse;

class QueryMatchCountHandler extends HandlerBase
{
     public function __invoke( Request $request, Response $response )
     {
          $params = $request->getParsedBody();
          if( !is_array($params)|| !$params['answer'] || !$params['guesses'] )
          {
               throw new BadRequestException( message: 'Malformed QueryMatchCountHandler parameters' );
          }
     
          $count = WordUtils::CountMatches( WordUtils::WORDLIST, $params['answer'], $params['guesses'] );
          return $this->JsonResponse(new QueryMatchCountResponse( $count ));
     }

}

?>