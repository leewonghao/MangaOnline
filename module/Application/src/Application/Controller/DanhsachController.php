<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * DanhsachController
 *
 * @author
 *
 * @version
 *
 */
class DanhsachController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated DanhsachController::indexAction() default action
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện online - trang ' . $this->params()->fromRoute('page', 1));
        $DS_Truyen = $this->Get_Table()->Danhsachtruyen()->setCurrentPageNumber($this->params()->fromRoute('page'));
        $DS_Truyen->setItemCountPerPage(20);
        return new ViewModel(array(
            'DS_truyen' => $DS_Truyen,
        ));
    }
    
    function Get_Table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm;
    }
}