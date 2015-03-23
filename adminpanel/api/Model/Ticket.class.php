<?php
namespace api\Model;


final class Ticket extends \api\Model\BaseModel {
    
    public
        $_id = null,
        $_board = null,
        $position = array (
            'z' => 0,
            'y' => 0,
            'x' => 0
            ),
        $color = '#FFFFFF',
        $content = '';
	
}