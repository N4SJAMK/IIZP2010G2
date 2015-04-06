<?php
namespace api;



final class ModelFactory
{
	//this is a test, modify values if need be
    private $validatingArray = array(
		'users' => array(
			'_id' => FILTER_VALIDATE_INT,
			'email' => FILTER_VALIDATE_EMAIL,
			'password' => FILTER_SANITIZE_ENCODED,
			'token' => FILTER_FLAG_NONE,
			'__boards' => array(
				'filter' => FILTER_VALIDATE_INT,
				'flags' => FILTER_FORCE_ARRAY
			)
		),
		'tickets' => array(
			'_id' => FILTER_VALIDATE_INT,
			'board' => FILTER_VALIDATE_INT,
			'position' => array (
				'filter' => FILTER_CALLBACK, 		//filter_var_array does not have recursion
				'options' => validate_array(array(	//this is a workaround
					'x' => FILTER_VALIDATE_INT,
					'y' => FILTER_VALIDATE_INT,
					'z' => FILTER_VALIDATE_INT
				))
			),
			'color' => array( //chech if color format is #FFFFFF
    			'filter' => FILTER_VALIDATE_REGEXP,
    			'flags'     => FILTER_NULL_ON_FAILURE,
    			'options'   => array('regexp'=>'/^#.[a-f0-9]{6}$/')
  		  	),
			'content' => FILTER_SANITIZE_ENCODED
		)
	);
    
    
    // $type is the name of mongo collection like users, boards, tickets, events
    public function createModel ($type, $array)
    {
		
		
        // array to stdClass object
        $model = json_decode(json_encode(filter_var_array($array, $validatingArray[$type])));
        
        
        // what is this shit??
        if (isset($model->__v)) { unset($model->__v); }
        
        
        // pretty id fields
        if (isset($model->_id)) { $model->_id = $model->_id->{'$id'}; }
        if (isset($model->board)) { $model->board = $model->board->{'$id'}; }
        if (isset($model->createdBy)) { $model->createdBy = $model->createdBy->{'$id'}; }
        if (isset($model->data->id)) { $model->data->id = $model->data->id->{'$id'}; }
        
        
        return $model;
        
    }
    
	private function validate_array($args) {
	    return function ($data) use ($args) {
	        return filter_input_array($data, $args);
	    };
	}
    
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