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
		
			'_id' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'board' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			
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
			
			'content' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'options' => array (
					'regexp' => '/.+/',
					'default'   => '',
				),
			),
		),
		//Validating board-array
		'boards' => array(
			'_id' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'accessCode' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'background' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'options' => array (
					'regexp' => '/.+/',
					'default'   => 'none',
                ),
            ),
			'createdBy' => array (
				'filter'  => FILTER_VALIDATE_REGEXP,
				'flags'   => FILTER_NULL_ON_FAILURE,
				'options' => array (
					'regexp' => '/.+/',
				),
			),
			
			'name' => FILTER_SANITIZE_ENCODED,
			'size' => array (
				'filter'  => FILTER_VALIDATE_INT,
				'flags'   => FILTER_REQUIRE_ARRAY,
				'options' => array (
					'default'   => array(
						'height' => 0,
						'width'  => 0,
					),
				),
			),
			'__tickets'  => array(
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
		
		$validated = filter_var_array($array, $this->validatingArray[$type]);
		
        // array to stdClass object
        $model = json_decode(json_encode($validated));
        
        
        // what is this shit??
        if (isset($model->__v)) { unset($model->__v); } 
        
        
        return $model;
        
    }
    
}