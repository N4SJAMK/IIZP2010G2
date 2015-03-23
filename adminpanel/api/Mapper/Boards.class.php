<?php
namespace api\Mapper;



final class Boards extends \api\Mapper\BaseMapper
{
    
    
    
        public function get($id = null)
        {
			return is_null($id) ? $this->getAll() : $this->getById($id);
        }
		
		
		public function getById($id)
		{
		
		
		}
		
		
		public function getAll()
		{
            $boards = $this->collection->find();
            $ticketMapper = new \api\Mapper\Tickets();
			
            $temp = array();
            foreach ($boards as $board) {
			print_r($board);
				$temp[] = new \api\Model\Board( array(
					'id'         => $board['_id'],
					'createdBy'  => $board['createdBy'],
					'accessCode' => $board['accessCode'],
					'background' => $board['background'],
					'size'       => array(
						'height' => $board['size']['height'], 
						'width'  => $board['size']['width']
						),
					'name'       => $board['name'],
					'tickets'	 => $ticketMapper->getByBoardId($board['_id'])
					));
            }
			print_r($temp);
			
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



