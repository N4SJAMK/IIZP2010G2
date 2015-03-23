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
            
            $temp = array();
            
            foreach ($boards as $board) {
                $temp[] = empty($board['name']) ? null : $board['name'];
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



