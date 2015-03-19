<?php




final class core_router
{
    
    
    
    
    private $_paths = array (
    
        'get' => array (
            'users'             =>  'users',
            'users/([0-9]+)'    =>  'users',
            'boards'            =>  'boards',
            'boards/([0-9]+)'   =>  'boards',
            'tickets'           =>  'tickets',
            'tickets/([0-9]+)'  =>  'tickets'
        ),
        
        'post' => array (
            'users'             =>  'users',
            'boards'            =>  'boards',
            'tickets'           =>  'tickets'
        ),
        
        'put' => array (
            'users/([0-9]+)'    =>  'users',
            'boards/([0-9]+)'   =>  'boards',
            'tickets/([0-9]+)'  =>  'tickets'
        ),
        
        'delete' => array (
            'users/([0-9]+)'    =>  'users',
            'boards/([0-9]+)'   =>  'boards',
            'tickets/([0-9]+)'  =>  'tickets'
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
                $controller = 'controller_'.$this->_controller;
                $controller = new $controller();
                $controller->$http_method($this->_id);
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




