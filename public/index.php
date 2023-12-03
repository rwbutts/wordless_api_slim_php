<?php
use Slim\Factory\AppFactory;
use App\Middleware\ErrorHandler;


require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$errorMiddlware = $app->addErrorMiddleware( true, true, true );
$errorMiddlware->setDefaultErrorHandler( new ErrorHandler( $app ) );
// Register routes
$routes = require __DIR__ . '/../src/Config/Routes.php';
$routes($app);

$app->run();




?>
