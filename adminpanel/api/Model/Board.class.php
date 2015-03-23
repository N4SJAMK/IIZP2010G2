<?php
namespace api\Model;

class Board extends \api\Model\BaseModel {
	
	public $id = null;
	public $accessCode = null;
	public $background = 'none';
	public $createdBy = null;
	public $name = '';
	public $size = array ('height' => null, 'width' => null);
	public $tickets = array();

	
}