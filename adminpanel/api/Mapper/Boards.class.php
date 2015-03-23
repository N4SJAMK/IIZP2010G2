<?php
namespace api\Mapper;



final class Board extends \api\Mapper\Mapper
{
    
    
    
    
        public function get($id = null)
        {
            $collection = $this->db->selectCollection('boards');
            $boards = $collection->find();
            
            $temp = array();
            
            foreach ($boards as $board) {
                $temp[] = empty($board['name']) ? null : $board['name'];
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



