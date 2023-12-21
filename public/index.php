<?php
use Slim\Factory\AppFactory;
use App\Middleware\ErrorHandler;
use App\Config\Config;

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$errorMiddlware = $app->addErrorMiddleware( false, true, true );
$errorMiddlware->setDefaultErrorHandler( new ErrorHandler( $app ) );

Config::getSetting('routes')( $app );

$app->run();

?>
