<?php
namespace api/model;

class ticket extends api/model/model {
	
	public $id = null;
	public $boardId = null;
	public $position = array('z' => NULL, 'y' => NULL, 'x' => NULL );
	public $color = '#FFFFFF';
	public $content = '';
	
}