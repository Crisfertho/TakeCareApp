<?php 

namespace Models;
use Models\ActiveRecord;

class Cita extends ActiveRecord {
    
    protected static $table = 'citas';
    protected static $columnsDB = ['id', 'date', 'time', 'userId'];

    public $id;
    public $date;
    public $time;
    public $userId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->time = $args['time'] ?? '';
        $this->userId = $args['userId'] ?? '';
    }

    public static function countAppointments($date, $time) {
        // Realiza una consulta SQL para contar las citas en la misma fecha y hora
        $query = "SELECT COUNT(*) as count FROM " . static::$table . " WHERE date = '{$date}' AND time = '{$time}'";
        $result = self::$db->query($query);
        $row = $result->fetch_assoc();
        
        return $row['count']; // Retorna el número de citas
        
    }
    
}