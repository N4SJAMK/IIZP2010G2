<?php
namespace api;



final class ModelFactory
{
    
    
    
    
    
    
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
        
        
        return $this->_validateModel($type, $model);
        
    }
    
    
    
    private function _validateModel ($type, $model)
    {
        
        // validate model properties against model type
        
        // if validate not ok
        // return false
        // else
        return $model;
        
    }
    
}