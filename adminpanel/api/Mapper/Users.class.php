<?php
namespace api\Mapper;



final class Users extends \api\Mapper\BaseMapper
{
    
    
    
    
        public function get($id = null)
        {
            $collection = $this->db->selectCollection('users');
            $users = $collection->find();
            
            $temp = array();
            
            foreach ($users as $user) {
                $temp[] = $user['email'];
            }
            
            echo json_encode($temp);
            
        }
        
        
        
        
        public function post()
        {
            
        }
        
        
        
        
        public function put($id = null)
        {
            
        }
        
        
        
        
        public function delete($id = null)
        {
            
        }
        
        
        
        
}



