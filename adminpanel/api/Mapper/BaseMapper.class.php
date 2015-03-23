<?php
namespace api\Mapper;



abstract class BaseMapper implements \api\Interfaces\Mapper
{
    
    
    protected $mongo;
    protected $db;
	protected $collection;
    
    
    
    
    function __construct ()
    {
        $this->mongo = new \MongoClient();
        $this->db = $this->mongo->selectDB('teamboard-dev');
		
		$classNameArray = explode('\\', strtolower(get_class($this)));
		$collectionName = end($classNameArray);
		$this->collection = $this->db->selectCollection($collectionName);
    }
    
    
    
    
}




