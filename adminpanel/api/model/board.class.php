<?php

class model_board {
	
	public $_id;
	public $_accessCode;
	public $_background;
	public $_createdBy;
	public $_name;
	public $_height;
	public $_width;
	public $_tickets;
	
	function __construct($params = array()) {
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_accessCode = isset($params['accessCode']) ? $params['accessCode'] : null;
		$this->_background = isset($params['background']) ? $params['background'] : 'none';
		$this->_createdBy = isset($params['createdBy']) ? $params['createdBy'] : null;
		$this->_name = isset($params['name']) ? $params['name'] : '';
		$this->_height = isset($params['height']) ? $params['height'] : null;
		$this->_width = isset($params['width']) ? $params['width'] : null;
		$this->_tickets = isset($params['tickets']) ? $params['tickets'] : array();
	}
	
}