<?php

namespace Admin\Model;
use Zend\InputFilter;
use Zend\InputFilterInterface;
use Zend\InputFilterAwareInterface;

class User implements InputFilterAwareInterface
{
    public $username;
    
    public $pass;
    
    public $fullname;
    
    public $admin;
}