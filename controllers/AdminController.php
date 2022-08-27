<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        //$fecha = date('Y-m-d');
        //debuguear($fecha);

        //Consultar la base de datos de citasservicios
        $consulta = "SELECT citas.id, citas.hora, ";
        $consulta .= "CONCAT( usuarios.nombre, ' ', usuarios.aPaterno) AS Cliente, usuarios.email, usuarios.telefono, ";
        $consulta .= "servicios.nombre AS Servicio, servicios.precio ";
        $consulta .= "FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.usuarioId = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN citasservicios ON citasservicios.citaId = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON citasservicios.servicioId = servicios.id ";
        $consulta .= "WHERE fecha =  '${fecha}' ";
        //debuguear($consulta);

        $citas = AdminCita::SQL($consulta);
        //debuguear($citas);

        $router->render('admin/index', [
            'nombreCompleto' => $_SESSION['nombreCompleto'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
