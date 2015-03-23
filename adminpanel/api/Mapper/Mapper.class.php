<?php
namespace api\Mapper;



abstract class Mapper implements \api\Interfaces\Mapper
{
    
    
    protected $mongo;
    protected $db;
    
    
    
    
    function __construct ()
    {
        $this->mongo = new \MongoClient();
        $this->db = $this->mongo->selectDB('teamboard-dev');
    }
    
    
    
    
}




