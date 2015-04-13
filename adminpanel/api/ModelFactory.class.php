<?php
namespace api;



final class ModelFactory
{
	//this is a test, modify values if need be
     private $validatingArray = array(
		//Validating user-array
		'users' => array(
		
		
			'_id' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'email' => array (
				'filter'  => FILTER_VALIDATE_EMAIL,
				'flags'   => FILTER_NULL_ON_FAILURE,
			),
				
			'password' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'token' => array (
				'filter'  => FILTER_UNSAFE_RAW,
			),
			
			'__boards' => array(
				'filter' => FILTER_VALIDATE_INT,
				'flags' => FILTER_FORCE_ARRAY,
				'options' => array (
					'default'   => 0,
				),
			),
		),
		//Validating ticket-array
		'tickets' => array(
			'_id' => FILTER_SANITIZE_ENCODED,
			'board' => FILTER_SANITIZE_ENCODED,
			
			
			'position' => array (
				'filter'  => FILTER_VALIDATE_INT,
				'flags'   => FILTER_REQUIRE_ARRAY,
				'options' => array (
					'default'   => array(
						'Z' => 0,
						'Y' => 0,
						'X' => 0,
					),
				),
			),
				
				
			'color' => array( //chech if color format is #FFFFFF
    			'filter' => FILTER_VALIDATE_REGEXP,
    			'flags'     => FILTER_NULL_ON_FAILURE,
    			'options'   => array('regexp'=>'/^#[[:xdigit:]]{6}$/')
  		  	),
			'content' => FILTER_SANITIZE_ENCODED
		),
		//Validating board-array
		'boards' => array(
			'_id'        = FILTER_SANITIZE_ENCODED,
			'accessCode' = FILTER_SANITIZE_ENCODED,
			'background' = FILTER_SANITIZE_ENCODED,
			'createdBy' = FILTER_SANITIZE_ENCODED,
			'name' = FILTER_SANITIZE_ENCODED,
			'size' = array (
				'filter'  => FILTER_VALIDATE_INT,
				'flags'   => FILTER_REQUIRE_ARRAY,
				'options' => array (
					'default'   => array(
						'height' => 0,
						'width'  => 0,
					),
				),
			),
			'__tickets'  = array(
				'filter' => FILTER_VALIDATE_INT,
				'flags' => FILTER_FORCE_ARRAY
			)
		)
	);
    
    
    // $type is the name of mongo collection like users, boards, tickets, events
    public function createModel ($type, $array)
    {
		
		// change id fields from mongoId object to string
        if (isset($array['_id'])) { $array['_id'] = $array['_id']->{'$id'}; }
        if (isset($array['board'])) { $array['board'] = $array['board']->{'$id'}; }
        if (isset($array['createdBy'])) { $array['createdBy'] = $array['createdBy']->{'$id'}; }
        if (isset($array['data']['id'])) { $array['data']['id'] = $array['data']['id']->{'$id'}; }
		
		$validated = filter_var_array($array, $validatingArray[$type]);
		
        // array to stdClass object
        $model = json_decode(json_encode($validated));
        
        
        // what is this shit??
        if (isset($model->__v)) { unset($model->__v); } 
        
        
        return $model;
        
    }
    
	/*private function validate_array($args) {
	    return function ($data) use ($args) {
	        return filter_input_array($data, $args);
	    };
	}*/
    
    //not used at this moment
    private function _validateModel ($type, $model)
    {
        
        // validate model properties against model type
        
        // if validate not ok
        // return false
        // else
        return $model;
        
    }
    
}