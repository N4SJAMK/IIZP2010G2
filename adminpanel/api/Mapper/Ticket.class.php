<?php
namespace api\Mapper;



final class Ticket extends \api\Mapper\Mapper
{
    
    
    
    
        public function get($id = null)
        {
            $collection = $this->db->selectCollection('tickets');
            $tickets = $collection->find();
            
            $temp = array();
            
            foreach ($tickets as $ticket) {
                $temp[] = empty($ticket['content']) ? null : $ticket['content'];
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



