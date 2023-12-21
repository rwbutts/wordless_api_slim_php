<?php
namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Wordless\WordUtils;
use App\Handlers\Responses\CheckWordResponse;

class CheckWordHandler extends HandlerBase
{
     public function handle( Request $request, Response $response, array $args  )  : Response
     {
          $exists = WordUtils::WordExists( $args[ 'word' ] );
          return $this->JsonResponse(new CheckWordResponse( $exists ));
      }

}

?>