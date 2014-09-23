<?php
namespace Admin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;

class Adminadapter
{
    protected $adapter;
    
    public function __construct($adapter){
        $this->adapter = $adapter;
    }
    
    public function getlogin($username, $password){
        $result = $this->adapter->query('SELECT count(*) countuser
                                        FROM user
                                        WHERE username = "'.$username.'" and pass = "'.$password.'"', Adapter::QUERY_MODE_EXECUTE);
        return $result->current();
    }
}