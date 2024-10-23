<?php 

namespace Models;

class CitaService extends ActiveRecord {
    protected static $table = 'citasservices';
    protected static $columnsDB = ['id', 'citaId', 'serviceId'];

    public $id;
    public $citaId;
    public $serviceId;

    public function __construct($args = []) 
    {
        $this ->id = $args['id'] ?? null;
        $this ->citaId = $args['citaId'] ?? '';
        $this ->serviceId = $args['serviceId'] ?? '';
    }

}