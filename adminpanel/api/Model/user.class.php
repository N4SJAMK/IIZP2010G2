<?php
namespace api/model;

// model class always starts with model_ 
class user extends api/model/model {
    
	public $id = null;
	public $email = null;
	public $password = null;
	public $token = null;
	public $boards = array();
	
}


$user = new user(array('id' => 1, 'email' => "matti@mieskolainen.fi"));
