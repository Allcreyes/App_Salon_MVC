<?php

namespace Controllers;

use MVC\Router;

class CitaController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $router->render('cita/index', [
            'nombreCompleto' => $_SESSION['nombreCompleto'],
            'id' => $_SESSION['id']
        ]);
    }
}
