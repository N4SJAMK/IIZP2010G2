<?php
namespace api;



final class router
{
    
    
    
    
    private $_paths = array (
    
        'get' => array (
            'users'             =>  'User',
            'users/([0-9]+)'    =>  'User',
            'boards'            =>  'Board',
            'boards/([0-9]+)'   =>  'Board',
            'tickets'           =>  'Ticket',
            'tickets/([0-9]+)'  =>  'Ticket',
			'events'			=>	'Event',
            'events/([0-9]+)'   =>  'Event'
        ),
        
        'post' => array (
            'users'             =>  'User',
            'boards'            =>  'Board',
            'tickets'           =>  'Ticket',
			'events'			=>	'Event'
        ),
        
        'put' => array (
            'users/([0-9]+)'    =>  'User',
            'boards/([0-9]+)'   =>  'Board',
            'tickets/([0-9]+)'  =>  'Ticket',
            'events/([0-9]+)'   =>  'Event'
        ),
        
        'delete' => array (
            'users/([0-9]+)'    =>  'User',
            'boards/([0-9]+)'   =>  'Board',
            'tickets/([0-9]+)'  =>  'Ticket',
            'events/([0-9]+)'   =>  'Event'
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
                if ($http_method == 'post') {
                    $controller->$http_method();
                } else {
                    $controller->$http_method($this->_id);
                }
            }
            
        }
        
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




