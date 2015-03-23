<?php
namespace api\Model;

class Ticket extends \api\Model\BaseModel {
	
	public $id = null;
	public $board = null;
	public $position = array('z' => NULL, 'y' => NULL, 'x' => NULL );
	public $color = '#FFFFFF';
	public $content = '';
	
}