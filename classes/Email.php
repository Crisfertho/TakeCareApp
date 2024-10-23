<?php 

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;


class Email {

    public $email;
    public $name;
    public $token;
    public function __construct($email, $name, $token) {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation()  {
        //crear objeto
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['MAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['MAIL_PORT'];
        $email->Username = $_ENV['MAIL_USER'];
        $email->Password = $_ENV['MAIL_PASS'];

        $email->setFrom('cuentas@takecare.com');//Aca va el dominio (Deploy)
        $email->addAddress('cuentas@takecare.com', 'TakeCare.com');
        $email->Subject = 'Confirmar tu cuenta';

        //set HTML
        $email->isHTML(TRUE);
        $email->CharSet = 'utf-8';

        $content = "<html>";
        $content .= "<p><strong>Hola: ". $this->email . "</strong> Bienvenido a TakeCareApp, acabas de crear una cuenta, para confirmar presiona en el siguiente enlace</p>";
        $content .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirm?token=" . $this->token . "'> Confirmar Cuenta</a> </p>";
        $content .= "<p>Si no solicisate esto, ignora este mensaje</p>";
        $content .= '</html>';
        $email->Body = $content;

        //enviar email
        $email->send();
    }

    public function sendInstructions() {
        //crear objeto
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['MAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['MAIL_PORT'];
        $email->Username = $_ENV['MAIL_USER'];
        $email->Password = $_ENV['MAIL_PASS'];

        $email->setFrom('cuentas@takecare.com');//Aca va el dominio (Deploy)
        $email->addAddress('cuentas@takecare.com', 'TakeCare.com');
        $email->Subject = 'Reestablecer Contraseña';

        //set HTML
        $email->isHTML(TRUE);
        $email->CharSet = 'utf-8';

        $content = "<html>";
        $content .= "<p><strong>Hola: ". $this->name . "</strong> Has solicitado reestablecer tu contraseña, haz click en el siguiente enlace para confirmar</p>";
        $content .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recover?token=" . $this->token . "'>Reestablecer Contraseña</a> </p>";
        $content .= "<p>Si no solicisate esto, ignora este mensaje</p>";
        $content .= '</html>';
        $email->Body = $content;

        //enviar email
        $email->send();
    }
}