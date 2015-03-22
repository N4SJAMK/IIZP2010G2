<?php
require_once("model.class.php");

// model class always starts with model_ 
class model_user extends model {
    
	public $id = null;
	public $email = null;
	public $password = null;
	public $token = null;
	public $boards = array();
	
}


$user = new user(array('id' => 1, 'email' => "matti@mieskolainen.fi"));
