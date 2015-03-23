<?php
namespace api\Mapper;



final class Users extends \api\Mapper\BaseMapper
{



	protected function _create ($user)
	{
		$boardsMapper = new \api\Mapper\Boards();
		
		return new \api\Model\User( array(
				'_id'        => (string)$user['_id'],
				'email'  	 => $user['email'],
				'password'   => $user['password'],
				'token'      => $user['token'],
				'__boards'	 => $boardsMapper->getAllBy('createdBy', $user['_id'])
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



