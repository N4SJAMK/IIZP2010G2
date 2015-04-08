<?php
namespace api;



final class ModelFactory
{
	//this is a test, modify values if need be
    /* private $validatingArray = array(
		'users' => array(
			'_id' => FILTER_SANITIZE_ENCODED,
			'email' => FILTER_VALIDATE_EMAIL,
			'password' => FILTER_SANITIZE_ENCODED,
			'token' => FILTER_FLAG_NONE,
			'__boards' => array(
				'filter' => FILTER_VALIDATE_INT,
				'flags' => FILTER_FORCE_ARRAY
			)
		),
		'tickets' => array(
			'_id' => FILTER_SANITIZE_ENCODED,
			'board' => FILTER_SANITIZE_ENCODED,
			'position' => array (
				'filter' => FILTER_CALLBACK, 		//filter_var_array does not have recursion this is a workaround
				'options' => validate_array(array(
					'x' => FILTER_VALIDATE_INT,
					'y' => FILTER_VALIDATE_INT,
					'z' => FILTER_VALIDATE_INT
				))
			),
			'color' => array( //chech if color format is #FFFFFF
    			'filter' => FILTER_VALIDATE_REGEXP,
    			'flags'     => FILTER_NULL_ON_FAILURE,
    			'options'   => array('regexp'=>'/^#[[:xdigit:]]{6}$/')
  		  	),
			'content' => FILTER_SANITIZE_ENCODED
		)
	);*/
    
    
    // $type is the name of mongo collection like users, boards, tickets, events
    public function createModel ($type, $array)
    {
		// what is this shit??
        // if (isset($model['__v'])) { unset($model['__v']); }
		
		// change id fields from mongoId object to string
        // if (isset($array['_id'])) { $array['_id'] = (string)$array['_id']; }
        // if (isset($array['board'])) { $array['board'] = (string)$array['board']; }
        // if (isset($array['createdBy'])) { $array['createdBy'] = (string)$array['createdBy']; }
        // if (isset($array['data']['id'])) { $array['data']['id'] = (string)$array['data']['id']; }
		
		$validated = $array; //filter_var_array($array, $validatingArray[$type]);
		
        // array to stdClass object
        $model = json_decode(json_encode($validated));
        
        
        // what is this shit??
        if (isset($model->__v)) { unset($model->__v); } 
        
        // pretty id fields
        if (isset($model->_id)) { $model->_id = $model->_id->{'$id'}; }
        if (isset($model->board)) { $model->board = $model->board->{'$id'}; }
        if (isset($model->createdBy)) { $model->createdBy = $model->createdBy->{'$id'}; }
        if (isset($model->data->id)) { $model->data->id = $model->data->id->{'$id'}; }
        
        
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