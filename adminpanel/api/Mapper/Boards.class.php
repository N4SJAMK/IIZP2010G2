<?php
namespace api\Mapper;



final class Boards extends \api\Mapper\BaseMapper
{



	protected function _create ($board)
	{
		$ticketsMapper = new \api\Mapper\Tickets();
		
		return new \api\Model\Board( array(
				'id'         => (string)$board['_id'],
				'createdBy'  => (string)$board['createdBy'],
				'accessCode' => $board['accessCode'],
				'background' => $board['background'],
				'size'       => array(
					'height' => $board['size']['height'], 
					'width'  => $board['size']['width']
					),
				'name'       => $board['name'],
				'tickets'	 => $ticketsMapper->getAllBy('board', $board['_id'])
				));
	
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



