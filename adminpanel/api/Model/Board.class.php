<?php
namespace api/Model;

class Board extends api/Model/BaseModel {
	
	public $id = null;
	public $accessCode = null;
	public $background = 'none';
	public $createdBy = null;
	public $name = '';
	public $height = null;
	public $width = null;
	public $tickets = array();

	
}