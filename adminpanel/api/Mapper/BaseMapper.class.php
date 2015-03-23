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
		return is_null($id) ? $this->getAll(array()) : $this->getOne(array('_id' => new \MongoId($id)));
	}
    
	public function getOne ($query)
	{
		$result = $this->collection->findOne($query);
		return is_null($result) ? null : $this->_create($result);
	}
    
	public function getAll ($query)
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
		return is_null($id) ? $this->deleteAll(array()) : $this->deleteOne(array('_id' => new \MongoId($id)));
	}
    
    public function deleteOne ($query)
    {
        $this->_deleteRecursive($query);
        return $this->collection->remove($query, array('justOne' => true));
    }
    
    public function deleteAll ($query)
    {
        $this->_deleteRecursive($query);
        return $this->collection->remove($query);
    }
    
    private function _deleteRecursive ($query)
    {
        $object = $this->getOne($query);
        $properties = get_object_vars($object);
        foreach ($properties as $key => $value)
        {
            if (preg_match('/^__(.+)$/', $key, $matches)) {
                $subQueryField = ($matches[1] == 'boards') ? 'createdBy' : 'board';
                
                $subObjectMapperName = '\api\Mapper\\'.ucfirst($matches[1]);
                $subObjectMapper = new $subObjectMapperName();
                $subObjectMapper->deleteAll(array($subQueryField => new \MongoId($object->_id)));
                
            }
        }
    }
    
    
    
}




