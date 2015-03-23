<?php
namespace api;



final class Router
{
    
    
    
    private 
        $_paths = array (
            'get' => array (
                'users'                     => 'users',
                'users/([0-9a-fA-F]{24})'   => 'users',
                'boards'                    => 'boards',
                'boards/([0-9a-fA-F]{24})'  => 'boards',
                'tickets'                   => 'tickets',
                'tickets/([0-9a-fA-F]{24})' => 'tickets',
                'events'                    => 'events'
                ),
            'post' => array (
                'users'   => 'users',
                'boards'  => 'boards',
                'tickets' => 'tickets'
                ),
            'put' => array (
                'users/([0-9a-fA-F]{24})'   => 'users',
                'boards/([0-9a-fA-F]{24})'  => 'boards',
                'tickets/([0-9a-fA-F]{24})' => 'tickets'
                ),
            'delete' => array (
                'users/([0-9a-fA-F]{24})'   => 'users',
                'boards/([0-9a-fA-F]{24})'  => 'boards',
                'tickets/([0-9a-fA-F]{24})' => 'tickets'
            )
        ),
        $_controller = null,
        $_id = null;
    
    
    
    
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
                $controller = new \api\Mapper($this->_controller);
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
            
            if (preg_match('/^'.str_replace('/', '\/', $pattern).'$/', $path, $tempmatches)) {
                $this->_controller = $tempcontroller;
                $this->_id = isset($tempmatches[1]) ? $tempmatches[1] : null;
                break;
            }
        }
        
    }
    
    
    
    
}