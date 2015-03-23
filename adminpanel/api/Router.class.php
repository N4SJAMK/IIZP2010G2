<?php
namespace api;



final class router
{
    
    
    
    
    private $_paths = array (
    
        'get' => array (
            'users'             =>  'Users',
            'users/([0-9]+)'    =>  'Users',
            'boards'            =>  'Boards',
            'boards/([0-9]+)'   =>  'Boards',
            'tickets'           =>  'Tickets',
            'tickets/([0-9]+)'  =>  'Tickets',
			'events'			=>	'Events',
            'events/([0-9]+)'   =>  'Events'
        ),
        
        'post' => array (
            'users'             =>  'Users',
            'boards'            =>  'Boards',
            'tickets'           =>  'Tickets',
			'events'			=>	'Events'
        ),
        
        'put' => array (
            'users/([0-9]+)'    =>  'Users',
            'boards/([0-9]+)'   =>  'Boards',
            'tickets/([0-9]+)'  =>  'Tickets',
            'events/([0-9]+)'   =>  'Events'
        ),
        
        'delete' => array (
            'users/([0-9]+)'    =>  'Users',
            'boards/([0-9]+)'   =>  'Boards',
            'tickets/([0-9]+)'  =>  'Tickets',
            'events/([0-9]+)'   =>  'Events'
        )
    );
    
    private $_controller = null;
    private $_id = null;
    
    
    
    
    function __construct ($path = null)
    {
        
        $http_method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_UNSAFE_RAW));
        
        // jos pyynti metodi on oikea
        if (isset($this->_paths[$http_method])) {
            
            $this->_parseController($path, $http_method);
            
            if (!is_null($this->_controller)) {
                $controller = '\api\Mapper\\'.$this->_controller;
                $controller = new $controller();
				$response = ($http_method == 'post') ? $controller->$http_method() : $controller->$http_method($this->_id);
				return $response;
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
            
            if (preg_match('/^'.str_replace('/', '\/', $pattern).'$/', $path, $tempmatches)) {
                $this->_controller = $tempcontroller;
                $this->_id = isset($tempmatches[1]) ? $tempmatches[1] : null;
                break;
            }
            
        }
        
        
    }
    
    
    
    
}




