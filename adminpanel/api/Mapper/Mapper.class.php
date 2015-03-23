<?php




abstract class core_controller implements interface_controller
{
    
    
    protected $mongo;
    protected $db;
    
    
    
    
    function __construct ()
    {
        $this->mongo = new MongoClient();
        $this->db = $this->mongo->selectDB('teamboard-dev');
    }
    
    
    
    
}




