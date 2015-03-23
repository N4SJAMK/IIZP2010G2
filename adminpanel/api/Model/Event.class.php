<?php
namespace api\Model;


final class Event extends \api\Model\BaseModel {
    
    public
        $_id = null,
		$type = null,
		$board = null,
		$data = array (
			'ticket' => null,
			
            'newAttributes' => array(
				//Ticket attributes
				'position' = array (
					'z' => 0,
					'y' => 0,
					'x' => 0
				),
				'color' = '#FFFFFF',
				'content' = '',
				
				//Board attributes
				'background' = 'none',
				'name' = '',
				'size' = array (
                    'height' => 0,
                    'width'  => 0
                )
			),
			
			'oldAttributes' => array(
				//Ticket attributes
				'position' = array (
					'z' => 0,
					'y' => 0,
					'x' => 0
				),
				'color' = '#FFFFFF',
				'content' = '',
				
				//Board attributes
				'background' = 'none',
				'name' = '',
				'size' = array (
                    'height' => 0,
                    'width'  => 0
                )
			)
		),
		
		$createdAt = null,
		$user = array (
            'id' => null,
            'type' => null,
            'username' => null
        )
    
}