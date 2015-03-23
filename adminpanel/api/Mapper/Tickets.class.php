<?php
namespace api\Mapper;



final class Tickets extends \api\Mapper\BaseMapper
{
    
    
    
    
        public function get($id = null)
        {
            return is_null($id) ? $this->getAll() : $this->getById($id);
            
        }
		
		public function getById($id)
		{
		
		}
		
		
		public function getByBoardId($id)
		{
			return array();
		
		}
		
		
		public function getAll()
		{
            $tickets = $this->collection->find();
            
            $temp = array();
            
            foreach ($tickets as $ticket) {
			print_r($ticket);
                $temp[] = new \api\Model\Board( array(
					'id'        => (string)$ticket['_id'],
					'boardId'	=> (string)$ticket['boardId'],
					'color' 	=> $ticket['color'],
					'content' 	=> $ticket['content'],
					'position'  => array(
						'z'  => $ticket['z'], 
						'x'  => $ticket['x'], 
						'y'  => $ticket['y']
						)
					));
            }
            
            return $temp;
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



