<?php
namespace api\Mapper;



final class Tickets extends \api\Mapper\BaseMapper
{



	protected function _create($ticket)
	{
		return new \api\Model\Ticket( array(
			'id'        => (string)$ticket['_id'],
			'boardId'	=> (string)$ticket['board'],
			'color' 	=> $ticket['color'],
			'content' 	=> $ticket['content'],
			'position'  => array(
				'z'  => $ticket['position']['z'], 
				'x'  => $ticket['position']['x'], 
				'y'  => $ticket['position']['y']
				)
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



