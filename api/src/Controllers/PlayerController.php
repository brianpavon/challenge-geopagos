<?php
namespace Controllers;

use Models\Player;
use Components\GenericResponse;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PlayerController{
    public function getAll(Request $request,Response $response, $args){
        try {
            $users = Player::all(['id', 'name', 'gender', 'gender_skills','created_at', 'updated_at']);
            
            if(!$users || count($users)==0){
                $response->getBody()->write(GenericResponse::obtain(false,"No se encontraron jugadores, verifique haber dado de alta los mismos."));
                $response->withStatus(400);
            }
            else{
                $response->getBody()->write(GenericResponse::obtain(true,"Se muestran todos los jugadores.",$users));
                $response->withStatus(200);
            }
        } catch (\Throwable $th) {
            $response->getBody()->write(GenericResponse::obtain(false,$th->getMessage()));
            $response->withStatus(500);
        }
        return $response;
    }

    public function addPlayer(Request $request, Response $response){
        try {
            $response->getBody()->write(GenericResponse::obtain(true,"funciona el post"));
        } catch (\Throwable $th) {
            $response->getBody()->write(GenericResponse::obtain(false,$th->getMessage()));
            $response->withStatus(500);
        }
        return $response;
    }
}