<?php 

namespace Controllers;

use Models\Cita;
use Models\CitaService;
use Models\Service;

class APIController {
    public static function index() {
        $services = Service::all();

        echo json_encode($services); //convierte a json 
    }

    public static function save() {

        // Recibe la fecha y la hora de la cita
        $date = $_POST['date'];
        $time = $_POST['time'];

        // Consulta cuántas citas existen para esa fecha y hora
        $existingCita = Cita::countAppointments($date, $time);

        // Verifica si ya hay 2 citas
        if ($existingCita >= 2) {
            echo json_encode(['result' => false, 'message' => 'No hay disponibilidad para esta hora']);
            return;
        }

      /***********************************************************/
        //Almacena la cita y devuelve el Id
        $cita = new Cita($_POST);
        $result = $cita->save();

        $id = $result['id'];

        //Almacena citas y servicios
        $idServices = explode(",",$_POST['services']);
       
        foreach($idServices as $idService) {
            $args = [
                'citaId' => $id,
                'serviceId' => $idService
            ];

            $citaServices = new CitaService($args);
            $citaServices->save();
        }

        echo json_encode(['result' => $result]);
    }
    public static function delete() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $cita = Cita::find($_POST['id']);
            $cita->delete();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    
}