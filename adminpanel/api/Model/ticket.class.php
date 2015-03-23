<?php

class model_ticket extends model_model {
	
	public $id = null;
	public $boardId = null;
	public $position = array('z' => NULL, 'y' => NULL, 'x' => NULL );
	public $color = '#FFFFFF';
	public $content = '';
	
}