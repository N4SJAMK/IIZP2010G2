<?php
namespace api\Mapper;



final class Users extends \api\Mapper\BaseMapper
{



	protected function _create ($user)
	{
		$boardsMapper = new \api\Mapper\Boards();
		
		return new \api\Model\User( array(
				'id'         => (string)$user['_id'],
				'email'  	 => $user['email'],
				'password'   => $user['password'],
				'token'      => $user['token'],
				'boards'	 => $boardsMapper->getAllBy('createdBy', $user['_id'])
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



