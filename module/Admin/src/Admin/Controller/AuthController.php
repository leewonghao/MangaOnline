<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    protected $storage;
    protected $authservice;
     
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
         
        return $this->authservice;
    }
     
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('Admin\Model\MyAuthorStorage');
        }
         
        return $this->storage;
    }
    
    public function indexAction()
    {
       $this->redirect()->toRoute('auth', array('action' => 'login'));
    }

    public function authenticateAction()
    {
        if($this->getRequest()->isPost()){
            $Isuser = $this->getTable()->getlogin($this->getRequest()->getPost('uname'), $this->getRequest()->getPost('pass'));
            if($Isuser->countuser > 0){
                $this->getSessionStorage()->setRememberMe(1);
                $this->getAuthService()->setStorage($this->getSessionStorage());
                $this->getAuthService()->getStorage()->write($this->getRequest()->getPost('uname'));
                return $this->redirect()->toRoute('admin');
            }
            else{
                return $this->redirect()->toRoute('auth', array('action' => 'login'));
            }
        }
    }
    
    public function getTable(){
        return $this->getServiceLocator()->get('Admin\Model\Adminadapter');
    }
    
    public function loginAction(){
        if ($this->getServiceLocator()->get('AuthService')->hasIdentity()){
            $this->redirect()->toRoute('admin');
        }
        else {
            $result = new ViewModel();
            $result->setTerminal(true);
            return $result;
        }
    }
    
    public function logoutAction(){
            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();
            $this->redirect()->toRoute('auth', array('action' => 'login'));
    }
}