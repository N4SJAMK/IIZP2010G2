<?php

// Dummy example of model


// model class always starts with model_ 
class model_user {
    
	private $_id;
	private $_email;
	private $_password;
	private $_token;
	
	
    // constructor takes params-array that holds key/value-pairs for private variables.
    // array key == instance variable _key
	function __construct ($params = array())
	{
		
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_email = isset($params['email']) ? $params['email'] : null;
		$this->_password = isset($params['password']) ? $params['password'] : null;
		$this->_token = isset($params['token']) ? $params['token'] : null;
	
	}
	
	
	public function getId ()
	{
		return $this->_id;
	}

	public function getEmail() {
		return $this->_email;
	}
	
	public function getPassword() {
		return $this->_password;
	}
	
	public function getToken() {
		return $this->_token;
	}
	
	public function setId($id) {
		$this->_id = $id;
	}
	
	public function setEmail($email) {
		$this->_email = $email;
	}
	
	public function setPassword($password) {
		$this->_password = $password;
	}
	
	public function setToken($token) {
		$this->_token = $token;
	}
	
}


$user = new user(array('id' => 1, 'email' => "matti@mieskolainen.fi"));
