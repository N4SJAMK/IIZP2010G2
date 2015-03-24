<?php
namespace api;



final class router
{
    
    
    
    
    private $_paths = array (
    
        'get' => array (
            'users'                      => 'Users',
            'users\/([0-9a-fA-F]{24})'   => 'Users',
            'boards'                     => 'Boards',
            'boards\/([0-9a-fA-F]{24})'  => 'Boards',
            'tickets'                    => 'Tickets',
            'tickets\/([0-9a-fA-F]{24})' => 'Tickets',
			'events'                     => 'Events',
            'events\/([0-9a-fA-F]{24})'  => 'Events'
        ),
        
        'post' => array (
            'users'   => 'Users',
            'boards'  => 'Boards',
            'tickets' => 'Tickets',
			'events'  => 'Events'
        ),
        
        'put' => array (
            'users\/([0-9a-fA-F]{24})'   => 'Users',
            'boards\/([0-9a-fA-F]{24})'  => 'Boards',
            'tickets\/([0-9a-fA-F]{24})' => 'Tickets',
            'events\/([0-9a-fA-F]{24})'  => 'Events'
        ),
        
        'delete' => array (
            'users\/([0-9a-fA-F]{24})'   => 'Users',
            'boards\/([0-9a-fA-F]{24})'  => 'Boards',
            'tickets\/([0-9a-fA-F]{24})' => 'Tickets',
            'events\/([0-9a-fA-F]{24})'  => 'Events'
        )
    );
    
    private $_controller = null;
    private $_id = null;
    
    
    
    
    function __construct ()
    {
    }
	
	
	
	public function getResponse ($path = null)
	{
        // input_post for html form fallback
        $http_method = strtolower(filter_input(INPUT_POST, 'REQUEST_METHOD', FILTER_UNSAFE_RAW));
        if (empty($http_method)) {
            $http_method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_UNSAFE_RAW));
        }
        
        // jos pyynti metodi on oikea
        if (isset($this->_paths[$http_method])) {
            
            $this->_parseController($path, $http_method);
            
            if (!is_null($this->_controller)) {
                $controller = '\api\Mapper\\'.$this->_controller;
                $controller = new $controller();
				return $controller->$http_method($this->_id);
            }
            
        }
		
		return null;
    }
	
	
	
    private function _parseController ($path, $http_method)
    {
        // poistetaan viimeinen keno jos sellainen on
        if (substr($path, -1) == '/') {
            $path = substr($path, 0, -1);
        }
        
        
        // etsitään oikea controlleri
        foreach ($this->_paths[$http_method] as $pattern => $tempcontroller) {
            
            if (preg_match('/^'.$pattern.'$/', $path, $tempmatches)) {
                $this->_controller = $tempcontroller;
                $this->_id = isset($tempmatches[1]) ? $tempmatches[1] : null;
                break;
            }
            
        }
        
        
    }
    
    
    
    
}




