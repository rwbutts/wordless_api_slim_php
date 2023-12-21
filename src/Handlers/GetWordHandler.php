<?php
namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Wordless\WordUtils;
use App\Handlers\Responses\GetWordResponse;

class GetWordHandler extends HandlerBase
{
     public function handle( Request $request, Response $response, array $args  ) : Response
     {
          //throw new HandlerException();
          $word = WordUtils::TodaysWord( (int)$args[ 'index'] );
          return $this->JsonResponse(new GetWordResponse( $word ));
      }

}

?>