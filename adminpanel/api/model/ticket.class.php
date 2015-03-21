<?php

class model_ticket {
	
	public $_id;
	public $_boardId;
	public $_position;
	public $_color;
	public $_content;
	
	function __construct($params = array()) {
		$this->_id = isset($params['id']) ? $params['id'] : null;
		$this->_boardId = isset($params['boardId']) ? $params['boardId'] : null;
		
		//Dont know about this, might be wrong
		$this->_position = isset($params['position']) ? $params['position'] :
							array('z' => NULL, 'y' => NULL, 'x' => NULL );
		
		$this->_color = isset($params['color']) ? $params['color'] : '#FFFFFF';
		$this->_content = isset($params['content']) ? $params['content'] : '';
	}
	
}