<?php
namespace api;



final class ModelFactory
{
	//this is a test, modify values if need be
    private $validatingArray = array(
		'users' => array(
			'_id' => array('validateType' => 'integer','required' => ''),
			'email' => array('validateType' => 'string'),
			'password' => array('validateType' => 'string','required' => ''),
			'token' => array('validateType' => 'string'),
			'__boards' => array('validateType' => 'array')
		)
	);
    
    
    // $type is the name of mongo collection like users, boards, tickets, events
    public function createModel ($type, $array)
    {
        // array to stdClass object
        $model = json_decode(json_encode($array));
        
        
        // what is this shit??
        if (isset($model->__v)) { unset($model->__v); }
        
        
        // pretty id fields
        if (isset($model->_id)) { $model->_id = $model->_id->{'$id'}; }
        if (isset($model->board)) { $model->board = $model->board->{'$id'}; }
        if (isset($model->createdBy)) { $model->createdBy = $model->createdBy->{'$id'}; }
        if (isset($model->data->id)) { $model->data->id = $model->data->id->{'$id'}; }
        
		
        if ($this->_validateModel($validatingArray[$type], (array) $model)){
			return $model;
		}
        return false;
        
    }
    
    
    
    private function _validateModel ($testArray, $modelArray)
    {
		//Go trough the testArray and check if corresponding array
		//elements are found in modelArray
        foreach($testArray as $key => $value) {
			if (isset($modelArray[$key])) {
				
				//Check if the last dimension of testArray is reached
				if(!isset($value['validateType'])) {
					//If not check the next dimension recursively
					if(!_validateModel ($testArray[$key], $modelArray[$key])) {
						return false;
					}
				}
			}
			else {
				return false;
			}
		}
		return true;		
		
        // validate model properties against model type
        
        // if validate not ok
        // return false
        // else
        //return $model;
        
    }
    
}