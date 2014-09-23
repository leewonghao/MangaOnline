<?php
namespace Admin\Model;

use Zend\Authentication\Storage;

class MyAuthorStorage extends Storage\Session
{
    public function setRememberMe($remember = 0, $time = 1209600){
        if($remember == 1){
            $this->session->getManager()->rememberMe($time);
        }
    }
    
    public function forgetMe(){
        $this->session->getManager()->forgetMe();
    }
}