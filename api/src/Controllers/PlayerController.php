<?php
namespace Controllers;

use Models\Player;
use Components\GenericResponse;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PlayerController{
    public function getAll(Request $request,Response $response, $args){
        $response->getBody()->write(GenericResponse::obtain(true,"TEST"));
        $response->withStatus(200);
        return $response;
    }
}