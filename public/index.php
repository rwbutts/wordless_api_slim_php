<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use App\Wordless\WordUtils;
use App\Wordless\GetWordResponse;
use App\Wordless\CheckWordResponse;
use App\Wordless\CountMatchesResponse;

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app->options('/{routes:.*}', function (Request $request, Response $response) {
     // CORS Pre-Flight OPTIONS Request Handler
     return $response;
});

$app->get('/', function (Request $request, Response $response) {
     $response->getBody()->write( 'Hello world!');
     return $response;
});

$app->get('/getword/{index}', function (Request $request, Response $response, array $args) {
     $word = WordUtils::TodaysWord( (int)$args[ 'index'] );
     $response->getBody()->write(\json_encode(new GetWordResponse( $word), JSON_THROW_ON_ERROR));
     return $response->withHeader( 'Content-Type', 'application/json' );
});

$app->get('/checkword/{word}', function (Request $request, Response $response, array $args) {
     $exists = WordUtils::WordExists( $args[ 'word' ] );
     $response->getBody()->write(\json_encode(new CheckWordResponse( $exists ), JSON_THROW_ON_ERROR));
     return $response->withHeader( 'Content-Type', 'application/json' );
});

$app->post('/querymatchcount', function (Request $request, Response $response) {
     $params = $request->getParsedBody();

     $count = WordUtils::CountMatches( WordUtils::WORDLIST, $params['answer'], $params['guesses'] );
     $response->getBody()->write(\json_encode(new CountMatchesResponse( $count ), JSON_THROW_ON_ERROR));
     return $response->withHeader( 'Content-Type', 'application/json' );
});

$app->run();




?>
