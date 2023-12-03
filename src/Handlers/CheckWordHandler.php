<?php
namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Wordless\WordUtils;
use App\Handlers\Responses\CheckWordResponse;

class CheckWordHandler extends HandlerBase
{
     public function __invoke( Request $request, Response $response, array $args  )
     {
          $exists = WordUtils::WordExists( $args[ 'word' ] );
          return $this->JsonResponse(new CheckWordResponse( $exists ));
      }

}

?>