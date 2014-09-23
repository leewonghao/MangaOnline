<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * XemnhieuController
 *
 * @author
 *
 * @version
 *
 */
class XemnhieuController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated XemnhieuController::indexAction() default action
        $DS_Truyen = $this->Get_Table()->DanhsachChapterXemnhieu()->setCurrentPageNumber($this->params()->fromRoute('page'));
        $DS_Truyen->setItemCountPerPage(20);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện online xem nhiều - trang ' . $this->params()->fromRoute('page', 1));
        return new ViewModel(array(
        		'DS_truyen' => $DS_Truyen,
        ));
    }
    
    function Get_Table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm;
    }
}