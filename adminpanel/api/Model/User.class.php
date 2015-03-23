<?php
namespace api\Model;


final class User extends \api\Model\BaseModel {
    
    public
        $_id      = null,
        $email    = null,
        $password = null,
        $token    = null,
        $__boards = array();
    
}