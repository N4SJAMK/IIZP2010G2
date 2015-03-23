<?php
namespace api/Model;

// model class always starts with model_ 
class User extends api/Model/BaseModel {
    
	public $id = null;
	public $email = null;
	public $password = null;
	public $token = null;
	public $boards = array();
	
}


