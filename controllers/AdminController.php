<?php 

namespace Controllers;

use Models\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
     
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $date = $_GET['date'] ?? date('Y-m-d');
        $dates = explode('-', $date);
        
        if(!checkdate($dates[1], $dates[2], $dates[0])) {
            header('Location: /404');
        }


        //consultar DB
        $consult = "SELECT citas.id, citas.date, citas.time, CONCAT( users.name, ' ', users.lastname) as client, ";
        $consult .= " users.email, users.phone, services.name as service, services.price  ";
        $consult .= " FROM citas  ";
        $consult .= " LEFT OUTER JOIN users ";
        $consult .= " ON citas.userId=users.id  ";
        $consult .= " LEFT OUTER JOIN citasservices ";
        $consult .= " ON citasservices.citaId=citas.id ";
        $consult .= " LEFT OUTER JOIN services ";
        $consult .= " ON services.id=citasservices.serviceId ";
        $consult .= " WHERE date =  '$date' ";

       $citas = AdminCita::SQL($consult);


        $router->render('admin/index', [
            'name' => $_SESSION['name'],
            'citas' => $citas,
            'date' => $date
        ]);
    }
}