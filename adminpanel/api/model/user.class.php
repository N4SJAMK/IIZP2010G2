<?php

// Dummy example of model


// model class always starts with model_ 
class model_user {
	
	private $_id;
	private $_email;
	private $_token;
	
	
    // constructor takes params-array that holds key/value-pairs for private variables.
    // array key == instance variable _key
	function __construct ($params = array())
	{
		
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_email = isset($params['email']) ? $params['email'] : null;
		$this->_token = isset($params['token']) ? $params['token'] : null;
	
	}
	
	
	public function getId ()
	{
		return $this->_id;
	}



}


$user = new user(array('id' => 1, 'email' => "matti@mieskolainen.fi"));
