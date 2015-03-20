<?php

class model_board {
	
	private $_id;
	private $_accessCode;
	private $_background;
	private $_createdBy;
	private $_name;
	private $_height;
	private $_width;
	
	function __construct() {
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_accessCode = isset($params['accessCode']) ? $params['accessCode'] : null;
		$this->_background = isset($params['background']) ? $params['background'] : 'none';
		$this->_createdBy = isset($params['createdBy']) ? $params['createdBy'] : null;
		$this->_name = isset($params['name']) ? $params['name'] : '';
		$this->_height = isset($params['height']) ? $params['height'] : null;
		$this->_width = isset($params['width']) ? $params['width'] : null;
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getAccessCode() {
		return $this->_accessCode;
	}
	
	public function getBackground() {
		return $this->_background;
	}
	
	public function getCreatedBy() {
		return $this->_createdBy;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getHeight() {
		return $this->_height;
	}
	
	public function getWidth() {
		return $this->_width;
	}
	
	public function setId($id) {
		$this->_id = $id;
	}
	
	public function setAccessCode($accessCode) {
		$this->_accessCode = $accessCode;
	}
	
	public function setBackground($background) {
		$this->_background = $background;
	}
	
	public function setCreatedBy($createdBy) {
		$this->_createdBy = $createdBy;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	
	public function setHeight($height) {
		$this->_height = $height;
	}
	
	public function setWidth($width) {
		$this->_width = $width;
	}
	
	
}