<?php

// Dummy example of model


// model class always starts with model_ 
class model_user {
    
	public $_id;
	public $_email;
	public $_password;
	public $_token;
	public $_boards;
	
	
    // constructor takes params-array that holds key/value-pairs for private variables.
    // array key == instance variable _key
	function __construct ($params = array())
	{
		
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_email = isset($params['email']) ? $params['email'] : null;
		$this->_password = isset($params['password']) ? $params['password'] : null;
		$this->_token = isset($params['token']) ? $params['token'] : null;
		$this->_boards = isset($params['boards']) ? $params['boards'] : array();
	}
	
}


$user = new user(array('id' => 1, 'email' => "matti@mieskolainen.fi"));
