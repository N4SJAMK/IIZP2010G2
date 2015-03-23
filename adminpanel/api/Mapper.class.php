<?php
namespace api;



final class Mapper
{
    
    
    
    private
        $mongo,
        $db,
        $collection;
    
    
    
    function __construct ($collection)
    {
        $this->mongo = new \MongoClient();
        $this->db = $this->mongo->selectDB('teamboard-dev');
		$this->collection = $this->db->selectCollection($collection);
    }
    
    
    
    // GETS
	public function get ($id = null)
	{
		return is_null($id) ? $this->_get(array()) : current($this->_get(array('_id' => new \MongoId($id))));
	}
    
    private function _get ($query)
    {
		$results = $this->collection->find($query);
		$return = array();
		foreach ($results as $result) {
            $return[] = $this->_createObject($result);
		}
		return $return;
    }
    
    
	
    
    
    // DELETES
	public function delete ($id = null)
	{
		return is_null($id) ? $this->_delete(array()) : $this->_delete(array('_id' => new \MongoId($id)), array('justOne' => true));
	}
    
    private function _delete ($query, $options = array())
    {
        $objects = $this->_get($query);
        
        foreach ($objects as $object) {
            $properties = get_object_vars($object);
            
            // if there's boards then object must be user
            // delete boards from that user
            if (isset($properties['boards'])) {
                $this->collection = $this->db->selectCollection('boards');
                $this->_delete(array('createdBy' => new \MongoId($object->id)));
                $this->collection = $this->db->selectCollection('users');
            }
            
            // if there's tickets then object must be board
            // delete tickets from that board
            if (isset($properties['tickets'])) {
                $this->collection = $this->db->selectCollection('tickets');
                $this->_delete(array('board' => new \MongoId($object->id)));
                $this->collection = $this->db->selectCollection('boards');
            }
            
        }
        
        return $this->collection->remove($query, $options);
        
    }
    
    
    
    
    
    public function put ($id = null)
    {
        
    }
    public function post ($id = null)
    {
        
    }
    
    
    
    
    
    private function _createObject ($array)
    {
        $object = json_decode(json_encode($array));
        
        if (isset($object->__v)) { unset($object->__v); }
        if (isset($object->board)) { $object->board = $object->board->{'$id'}; }
        if (isset($object->createdBy)) { $object->createdBy = $object->createdBy->{'$id'}; }
        if (isset($object->_id)) { $object->id = $object->_id->{'$id'}; unset($object->_id); }
        
        // events magic
        if (isset($object->data->id)) { $object->data->id = $object->data->id->{'$id'}; }
        
        switch ($this->collection->getName()) {
            
            // adds boards to user
            case 'users':
                $this->collection = $this->db->selectCollection('boards');
                $object->boards = $this->_get(array('createdBy' => new \MongoId($object->id)));
                $this->collection = $this->db->selectCollection('users');
                break;
                
            // adds tickets to board
            case 'boards':
                $this->collection = $this->db->selectCollection('tickets');
                $object->tickets = $this->_get(array('board' => new \MongoId($object->id)));
                $this->collection = $this->db->selectCollection('boards');
                break;
                
        }
        
        return $object;
        
    }
    
    
    
}




