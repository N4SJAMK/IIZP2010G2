<?php

class model_model {
	
	// constructor takes params-array that holds key/value-pairs for private variables.
    // array key == instance variable key
	function __construct($params = array()) {
		
		foreach ($params as $key => $value) {
			
			if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}
	
}