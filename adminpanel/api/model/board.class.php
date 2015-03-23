<?php
namespace api/model;

class board extends api/model/model {
	
	public $id = null;
	public $accessCode = null;
	public $background = 'none';
	public $createdBy = null;
	public $name = '';
	public $height = null;
	public $width = null;
	public $tickets = array();

	
}