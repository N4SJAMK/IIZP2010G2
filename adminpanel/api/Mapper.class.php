<?php
namespace api;



final class Mapper
{
    
    
    
    private
        $mongo,
        $db,
        $modelFactory;
    
    
    
    
    function __construct ()
    {
        $this->mongo = new \MongoClient();
        $this->db = $this->mongo->selectDB('teamboard-dev');
        $this->modelFactory = new \api\ModelFactory();
    }
    
    
    
    
    // GETS
    public function get ($from, $id = null)
    {
        if ($from == 'mongo') {
            return $this->_mongodump();
        }
        return is_null($id) ? $this->_get($from, array()) : current($this->_get($from, array('_id' => new \MongoId($id)), true));
    }
    
    private function _get ($from, $query, $recursive = false)
    {
        $collection = $this->db->selectCollection($from);
        $results = $collection->find($query);
        
        $models = array();
        foreach ($results as $result) {
            
            $model = $this->modelFactory->createModel($from, $result);
            
            if ($model) {
                
				if ($recursive) {
					switch ($from) {
						// adds boards to user
						case 'users':
							$model->boards = $this->_get('boards', array('createdBy' => new \MongoId($model->_id)), false);
							break;
						// adds tickets to board
						case 'boards':
							$model->tickets = $this->_get('tickets', array('board' => new \MongoId($model->_id)), false);
							break;
					}
				}
                
                $models[] = $model;
            }
            
        }
        
        return $models;
    }
    
    
    
    
    // DELETES
    public function delete ($from, $id = null)
    {
        return is_null($id) ? $this->_delete($from, array()) : $this->_delete($from, array('_id' => new \MongoId($id)), array('justOne' => true));
    }
    
    private function _delete ($from, $query, $options = array())
    {
        $collection = $this->db->selectCollection($from);
        
        $models = $this->_get($from, $query);
        
        foreach ($models as $model) {
            $properties = get_object_vars($model);
            
            // if there's boards then model must be user
            // delete boards from that user
            if (isset($properties['boards'])) {
                $this->_delete('boards', array('createdBy' => new \MongoId($model->_id)));
            }
            
            // if there's tickets then model must be board
            // delete tickets from that board
            if (isset($properties['tickets'])) {
                $this->_delete('boards', array('board' => new \MongoId($model->_id)));
            }
            
        }
        
        return $collection->remove($query, $options);
        
    }
    
    
    
    
    public function put ($to, $id = null)
    {
    }
    
    
    
    
    public function post ($to)
    {
        if ($to == 'mongo') {
            return $this->_mongorestore();
        }
        
        $data = $_POST;
        
        // unset unnecessary fields
        unset($data['REQUEST_METHOD']);
        
        
        //modelfactory expects mongoid objects..
        $data['_id'] = new \MongoId();
        
        switch ($to) {
            case 'boards':
                $data['accessCode'] = null;
                $data['background'] = 'none';
                $data['createdBy'] = new \MongoId($data['createdBy']);
                $data['size'] = array ('height' => 8, 'width' => 8);
            break;
            
            case 'tickets':
                $data['board'] = new \MongoId($data['board']);
                $data['position'] = array ('z' => 0, 'x' => 0, 'y' => 0);
            break;
            
            case 'users':
                $data['password'] = crypt($data['password'], "$2a$10$".bin2hex(\mcrypt_create_iv(64, MCRYPT_DEV_RANDOM))."$");
            break;
        }
        
        
        
        $model = $this->modelFactory->createModel($to, $data);
        
        
        if ($model)
        {
            $collection = $this->db->selectCollection($to);
            
            // mongoid objects again....
            unset($model->_id);
            if ($to == 'boards')  { $model->createdBy = new \MongoId($model->createdBy); }
            if ($to == 'tickets') { $model->board     = new \MongoId($model->board);     }
            
            return $collection->insert($model);
        }
        
        return null;
    }
    
    
    
    
    private function _mongodump ()
    {
        $timestamp = time();
        
        // this is sooooo safe..
        exec('mkdir /home/vagrant/teamboard-adminpanel/api/dump/'.$timestamp);
        exec('mongodump --db teamboard-dev --out /home/vagrant/teamboard-adminpanel/api/dump/'.$timestamp.'/');
        exec('zip -rj /home/vagrant/teamboard-adminpanel/api/dump/'.$timestamp.'.zip /home/vagrant/teamboard-adminpanel/api/dump/'.$timestamp);
        exec('rm -rf /home/vagrant/teamboard-adminpanel/api/dump/'.$timestamp);
        
        $file_url = 'http://localhost:8001/api/dump/'.$timestamp.'.zip';
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary'); 
        header('Content-disposition: attachment; filename="'.basename($file_url).'"'); 
        readfile($file_url);
        
        return false;
    }
    
    
    private function _mongorestore ()
    {
        return $_POST;
    }
    
    
    
    
    
}