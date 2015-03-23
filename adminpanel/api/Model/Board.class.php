<?php
namespace api\Model;


final class Board extends \api\Model\BaseModel {
	
    public
        $_id        = null,
        $accessCode = null,
        $background = 'none',
        $_createdBy = null,
        $name       = '',
        $size       = array (
                        'height' => 0,
                        'width'  => 0
                    ),
        $__tickets  = array ();

}