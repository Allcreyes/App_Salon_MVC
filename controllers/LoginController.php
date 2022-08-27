<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function crear(Router $router)
    {
        $usuario = new Usuario;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que $alertas este vacio
            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hash de pass
                    $usuario->hashPass();
                    $usuario->token();
                    $email = new Email($usuario->email, $usuario->aPaterno, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario && $usuario->confirmado === "1") {
                    $usuario->token();
                    $usuario->guardar();
                    $email = new Email($usuario->email, $usuario->aPaterno, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta('exito', 'Hemos enviado un correo electrónico con las instrucciones para reestablecer tu contraseña');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no ha sido confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrasena = new Usuario($_POST);
            $alertas = $contrasena->validarPassword();
            if (empty($alertas)) {
                $usuario->contrasena = null;
                $usuario->contrasena = $contrasena->contrasena;
                $usuario->hashPass();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    if ($usuario->comprobarPasswordAndVerificado($auth->contrasena)) {

                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['aPaterno'] = $usuario->aPaterno;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['nombreCompleto'] = $usuario->nombre . " " . $usuario->aPaterno;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['telefono'] = $usuario->telefono;

                        $_SESSION['confirmado'] = $usuario->confirmado;
                        $_SESSION['usuario'] = $usuario->usuario;
                        $_SESSION['fechaAlta'] = $usuario->fechaAlta;
                        $_SESSION['login']  = true;

                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];
        header('Location: /');
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Si ya habias confirmado tu cuenta, intenta iniciar sesión.<br><br>En caso de no recordar tu password intenta en la opción: Olvidaste tu contraseña?, de la pagina principal');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente<br><br> Inicia sesión y disfruta de nuestros servicios, productos y promociones');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
