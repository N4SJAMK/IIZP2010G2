<?php




final class controller_users extends core_controller
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



