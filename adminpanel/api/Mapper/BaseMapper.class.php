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
    
    
    
    
	public function get ($id = null)
	{
		return is_null($id) ? $this->getAll() : $this->getOne(array('_id' => new \MongoId($id)));
	}
    
	public function getOne ($query = array())
	{
		$result = $this->collection->findOne($query);
		return is_null($result) ? null : $this->_create($result);
	}
    
	public function getAll ($query = array())
	{
		$results = $this->collection->find($query);
		$return = array();
		foreach ($results as $result) {
			$return[] = $this->_create($result);
		}
		return $return;
	}
    
	
    
    
    
	public function delete ($id = null)
	{
		return is_null($id) ? $this->deleteAll() : $this->deleteOne(array('_id' => new \MongoId($id)));
	}
    
    public function deleteOne ($query = array())
    {
        return $this->collection->remove($query, array('justOne' => true));
    }
    
    public function deleteAll ($query = array())
    {
        return $this->collection->remove($query);
    }
    
    
    
    
}




