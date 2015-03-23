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
    
    
    
	public function get($id = null)
	{
		return is_null($id) ? $this->getAll() : $this->getBy('_id', new \MongoId($id));
	}
    
    
    
	public function getBy($column, $data)
	{
		$result = $this->collection->findOne( array(
				$column => $data
			));
			
		return $this->_create($result);
	}
    
    
    
	public function getAllBy($column, $data)
	{
		$results = $this->collection->find( array(
				$column => $data
			));
			
		$temp = array();
		foreach ($results as $result) {
			$temp[] = $this->_create($result);
		}
		return $temp;
		
	}
    
    
    
	public function getAll()
	{
		$results = $this->collection->find();
		
		$temp = array();
		foreach ($results as $result) {
			$temp[] = $this->_create($result);
		}
		return $temp;
	}
    
    
    
}




