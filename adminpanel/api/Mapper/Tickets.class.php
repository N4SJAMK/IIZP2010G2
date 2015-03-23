<?php
namespace api\Mapper;



final class Tickets extends \api\Mapper\BaseMapper
{



	protected function _create($ticket)
	{
		return new \api\Model\Ticket( array(
			'_id'       => (string)$ticket['_id'],
			'board'     => (string)$ticket['board'],
			'position'  => array(
				'z'  => isset($ticket['position']['z']) ? intval($ticket['position']['z']) : 0, 
				'x'  => intval($ticket['position']['x']),
				'y'  => intval($ticket['position']['y'])
				),
			'color'     => $ticket['color'],
			'content'   => $ticket['content']
			));
	}
	
	
	
	public function post()
	{
		
	}
	
	
	
	public function put($id = null)
	{
		
	}
	
	
	
}


