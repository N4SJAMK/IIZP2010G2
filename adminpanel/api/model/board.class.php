<?php
require_once("model.class.php");

class model_board extends model {
	
	public $id = null;
	public $accessCode = null;
	public $background = 'none';
	public $createdBy = null;
	public $name = '';
	public $height = null;
	public $width = null;
	public $tickets = array();

	
}