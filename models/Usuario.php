<?php

namespace Model;

class Usuario extends ActiveRecord
{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'aPaterno', 'nombre', 'email', 'telefono', 'admin', 'confirmado', 'token', 'usuario', 'contrasena', 'fechaAlta'];

    public $id;
    public $aPaterno;
    public $nombre;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $usuario;
    public $contrasena;
    public $fechaAlta;

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->aPaterno = $args['aPaterno'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->usuario = $args['usuario'] ?? '';
        $this->contrasena = $args['contrasena'] ?? '';
        $this->fechaAlta = date('Y/m/d');
    }

    //Mensajes de validacion para la creación de una cuenta
    public function validarNuevaCuenta()
    {
        if (!$this->aPaterno && !$this->nombre) {
            self::$alertas['error'][] = "Tu apellido y nombre son necesarios";
        } else {
            if (!$this->aPaterno) {
                self::$alertas['error'][] = 'Tu apellido es necesario';
            }
            if (!$this->nombre) {
                self::$alertas['error'][] = 'Tu nombre es necesario';
            }
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'Ingresa un correo para poder crear tu cuenta';
        }
        if (!$this->usuario && !$this->contrasena) {
            self::$alertas['error'][] = "Es necesario que ingreses un nombre de usuario y contraseña";
        } else {
            if (!$this->usuario) {
                self::$alertas['error'][] = 'Es necesario elegir un nombre de usuario';
            }
            if (!$this->contrasena || strlen($this->contrasena) < 6) {
                self::$alertas['error'][] = "Ingresa una contraseña con un mínimo de 6 caracteres";
            }
        }
        return self::$alertas;
    }

    public function validarLogin()
    {
        if (!$this->email && !$this->contrasena) {
            self::$alertas['error'][] = "El correo y contraseña son obligatorios";
        }
        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'Tu cuenta de correo es obligatoria';
        }
        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->contrasena) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (strlen($this->contrasena) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener un mínimo de 6(seis) caracteres';
        }
        return self::$alertas;
    }

    //Revisa por cuentas existentes
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = "Ya existe un usuario registrado con esa cuenta de correo. <br> Verifica que tu correo este bien escrito o intenta recuperar tu contraseña";
        }
        return $resultado;
    }

    public function hashPass()
    {
        $this->contrasena = password_hash($this->contrasena, PASSWORD_BCRYPT);
    }

    public function token()
    {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($contrasena)
    {
        $resultado = password_verify($contrasena, $this->contrasena);
        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'El password es incorrecto o tu cuenta aun no ha sido confirmada';
        } else {
            return true;
        }
    }
}
