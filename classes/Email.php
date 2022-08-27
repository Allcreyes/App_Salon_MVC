<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv as Dotenv;

$dotenv = Dotenv::createImmutable('../includes/.env');
$dotenv->safeLoad();

class Email
{
    public $email;
    public $aPaterno;
    public $nombre;
    public $token;

    public function __construct($email, $aPaterno,  $nombre, $token)
    {
        $this->email = $email;
        $this->aPaterno = $aPaterno;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {


        // $phpmailer = new PHPMailer();
        // $phpmailer->isSMTP();
        // $phpmailer->Host = 'smtp.mailtrap.io';
        // $phpmailer->SMTPAuth = true;
        // $phpmailer->Port = 2525;
        // $phpmailer->Username = '515c16ac662153';
        // $phpmailer->Password = '6e8ea7dcc27951';


        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'armocte18@gmail.com';
        $phpmailer->Password = 'aylxwfhtpkmouskk';


        // $phpmailer->Host = $_ENV['MAIL_HOST'];
        // $phpmailer->SMTPAuth = true;
        // $phpmailer->Port = $_ENV['MAIL_PORT'];
        // $phpmailer->Username = $_ENV['MAIL_USER'];
        // $phpmailer->Password = $_ENV['MAIL_PASSWORD'];




        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->setFrom('cuentas@appSalon.com', 'Estética SHERLYN');
        $phpmailer->addAddress($this->email);

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->Encoding = 'base64';
        $phpmailer->Subject = 'Confirma tu cuenta para comenzar';

        // Set HTML
        $contenido = "<html>";
        $contenido .= "<p>Estimado(a)<strong> " . $this->nombre . " " . $this->aPaterno . "</strong>,</p><br>";
        $contenido .= "<p>Gracias por crear tu cuenta en <strong>Estética SHERLYN</strong>, ahora podrás acceder a  nuestros servicios, productos y promociones, solo debes confirmarla presionando el siguente enlace:</p><br>";
        $contenido .= "<p>Presiona aquí para confirmar:<strong> <a href='http://". $_SERVER["HTTP_HOST"] . "/confirmar-cuenta?token=". $this->token . "'>Confirmar Cuenta</a></strong></p><br>";
        $contenido .= "<p>Si tu no solicitaste crear una cuenta, puedes ignorar este mensaje</p><hr>";
        $contenido .= "<p>Este correo electrónico contiene información legal confidencial y privilegiada.<br> Si Usted no es el destinatario a quien se desea enviar este mensaje, tendrá prohibido darlo a conocer a persona alguna, así como a reproducirlo o copiarlo.<br> Si recibe este mensaje por error, favor de notificarlo al remitente de inmediato y desecharlo de su sistema.</p>";
        $contenido .= "</html>";
        $phpmailer->Body = $contenido;


        if ($phpmailer->send()) {
            $mensaje = "Mensaje enviado correctamente";
        } else {
            $mensaje = "El mensaje no pudo ser enviado";
        }
    }


    public function enviarInstrucciones()
    {
        // $phpmailer = new PHPMailer();
        // $phpmailer->isSMTP();
        // $phpmailer->Host = 'smtp.mailtrap.io';
        // $phpmailer->SMTPAuth = true;
        // $phpmailer->Port = 2525;
        // $phpmailer->Username = '515c16ac662153';
        // $phpmailer->Password = '6e8ea7dcc27951';


        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'armocte18@gmail.com';
        $phpmailer->Password = 'aylxwfhtpkmouskk';

         // $phpmailer->Host = $_ENV['MAIL_HOST'];
        // $phpmailer->SMTPAuth = true;
        // $phpmailer->Port = $_ENV['MAIL_PORT'];
        // $phpmailer->Username = $_ENV['MAIL_USER'];
        // $phpmailer->Password = $_ENV['MAIL_PASSWORD'];

        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->setFrom('cuentas@appSalon.com', 'Estética SHERLYN');
        $phpmailer->addAddress($this->email);

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->Encoding = 'base64';
        $phpmailer->Subject = 'Reestablece tu contraseña';

        // Set HTML
        $contenido = "<html>";
        $contenido .= "<p>Estimado(a)<strong> " . $this->nombre . " " . $this->aPaterno . "</strong>, has solicitado reestablecer tu contraseña, haz clic el siguiente enlace para hacerlo.</p><br>";
        $contenido .= "<p>Presiona aquí para reestablecer:<strong> <a href='http://". $_SERVER["HTTP_HOST"] . "/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a></strong></p><br>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje.</p><hr>";
        $contenido .= "<span>Este correo electrónico contiene información legal confidencial y privilegiada.<br> Si Usted no es el destinatario a quien se desea enviar este mensaje, tendrá prohibido darlo a conocer a persona alguna, así como a reproducirlo o copiarlo.<br> Si recibe este mensaje por error, favor de notificarlo al remitente de inmediato y desecharlo de su sistema.</span>";
        $contenido .= "</html>";
        $phpmailer->Body = $contenido;

        if ($phpmailer->send()) {
            $mensaje = "Mensaje enviado correctamente";
        } else {
            $mensaje = "El mensaje no pudo ser enviado";
        }
    }
}
