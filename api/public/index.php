<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Config\Database;

use Middlewares\JsonMiddleware;
use Middlewares\CorsMiddleware;
use Components\GenericResponse;

use Controllers\PlayerController;
use Models\Tournament;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/challenge-geopagos/api/public');
new Database;

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->group('/players',function(RouteCollectorProxy $group){
    $group->get('[/]',PlayerController::class.":getAll");
    $group->post('/add-player',PlayerController::class.":addPlayer");
});

$app->group('/tournament',function(RouteCollectorProxy $group){
    $group->get('/start/{gender}',TournamentController::class.":startTournament");
});

$app->add(new CorsMiddleware());
$app->add(new JsonMiddleware());
$app->addBodyParsingMiddleware();

$app->run();