<?php 

namespace Models;

class AdminCita extends ActiveRecord {
    protected static $table = 'citasservices';
    protected static $columnsDB = ['id', 'date', 'time', 'client', 'email', 'phone', 
    'service', 'price'];

    public $id; 
    public $date; 
    public $time; 
    public $client; 
    public $email; 
    public $phone; 
    public $service; 
    public $price;  

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->time = $args['time'] ?? '';
        $this->client = $args['client'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->service = $args['service'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}