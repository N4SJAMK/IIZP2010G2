<?php
namespace api\Mapper;



final class Boards extends \api\Mapper\BaseMapper
{



	protected function _create ($board)
	{
		$ticketsMapper = new \api\Mapper\Tickets();
		
		return new \api\Model\Board( array(
				'_id'        => (string)$board['_id'],
				'accessCode' => $board['accessCode'],
				'background' => $board['background'],
				'_createdBy'  => (string)$board['createdBy'],
				'name'       => $board['name'],
				'size'       => array(
					'height' => intval($board['size']['height']), 
					'width'  => intval($board['size']['width'])
					),
				'__tickets'	 => $ticketsMapper->getAll(array('board' => $board['_id']))
				));
	
	}
	
	
	
	public function post()
	{
		
	}
	
	
	
	public function put($id = null)
	{
		
	}
	
	
	
}



