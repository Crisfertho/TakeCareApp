<?php 

namespace Controllers;

use MVC\Router;
use Models\User;
use Classes\Email;


class LoginController {
    public static function login (Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST); //instanciar modelo user
            $alerts = $auth->validateLogin(); //muestra errores en caso de.c
            
            if(empty($alerts)) {
                //Comprobar que el usuario existe
                $user =  User::where('email', $auth->email);

                if($user) {
                    //verificar password
                    if($user->findoutPassAndVerified($auth->password)) {
                        //autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . " " . $user->lastname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        //redireccionamiento
                        if($user->admin === "1") {
                           $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }   
                } else {
                    User::setAlert('error', 'Usuario no Registrado');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/login', [
           'alerts' => $alerts
        ]);
    }
    public static function logout (){
        session_start();
        $_SESSION = [];
        header('Location: /');

    }
    public static function forgot (Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validateEmail();

            if(empty($alerts)) {
                $user = User::where('email', $auth->email);

                if($user && $user->confirm === "1") {
                    //generar token de 1 solo uso
                    $user->createToken();
                    $user->save();

                    //Enviar el email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();
                    //Alerta de exito
                    User::setAlert('exito','Revisa tu correo electrónico');

                } else {
                    User::setAlert('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/forgot', [
            'alerts' => $alerts
        ]); //Renderizar la vista
    }
    public static function recover (Router $router){
        $alerts = []; 
        $error = false;

        $token = s($_GET['token']);

        //Buscar usuario por token
        $user = User::where('token',$token);
        if(empty($user)) {
            User::setAlert('error', 'Token No Válido');
            $error  = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //crear y guardar nuevo password
            $password =  new User($_POST);
            $alerts = $password->validatePassword();

            if(empty($alerts)) {
                $user->password = null;

                $user->password = $password->password;
                $user->hashPassword();
                $user->token = null;

                $result = $user->save();
                //si lo guarda correctamente, redirecionar al Login
                if($result) {
                    // Crear mensaje de exito
                    User::setAlert('succes', 'Password Actualizado Correctamente');
                    
                    // Redireccionar al login tras 3 segundos
                    header('Refresh: 3; url=/');
                }

            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/password-recover', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }
    public static function register (Router $router){
        
        $user = new User($_POST);

        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
          
         $user->sync($_POST);
         $alerts = $user->validateNewUser();

         // Si no hay errores, proceder con la lógica de registro (aquí solo mostramos la validación)
            if (empty($alerts['error'])) {
                // Verificar que usuario no este registrado
                $result = $user->existUser();

                if($result->num_rows) {
                    $alerts = User::getAlerts();
                } else {
                    //hash password
                    $user->hashPassword();

                    //generar token único
                    $user->createToken();

                    //enviar email
                    $email = new Email($user->email, $user->name, $user->token); //Lo importa de classes
                    $email->sendConfirmation();
                
                    //crear el usuario
                    $result = $user->save();
                    if($result) {
                       header('Location: /message');
                    }

                    debug($user);
                    //No registrados
                }
            }

        }
        $router->render('auth/register', [
            'user' => $user,
            'alerts' => $alerts
        ]);

    }
    public static function message(Router $router) {
        $router->render('auth/message');
    }
    public static function confirm(Router $router) {
        $alerts = []; 

        $token = s($_GET['token']);
        $user = User::where('token', $token);
        
        if($user && !empty($user)) {
            //modificar a usuario confirmado
            $user->confirm = "1";
            $user->token = "";
            $user->save();
            User::setAlert('succes', 'Cuenta comprobada correctamente');
        } else {
            // Mostrar mensaje de error
            User::setAlert('error', 'Token no Válido');
        }
        
        $alerts = User::getAlerts();
        $router->render('auth/confirm', [
            'alerts' => $alerts
        ]);
    }
}
   