<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * TheloaiController
 *
 * @author
 *
 * @version
 *
 */
class TheloaiController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated TheloaiController::indexAction() default action
        $id = $this->params()->fromRoute('id', 0);
        $DS_Truyen = $this->Get_Table()->Danhsachtruyen_TheLoai($id)->setCurrentPageNumber($this->params()->fromRoute('page'));
        $DS_Truyen->setItemCountPerPage(20);
        $TenTL = $this->Get_Table()->TenTL($id);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện thể loại '. $TenTL->Tenloai .' - trang ' . $this->params()->fromRoute('page', 1));
        return new ViewModel(array(
        		'DS_truyen' => $DS_Truyen,
                'TenTL' => $TenTL,
        ));
    }
    
    function Get_Table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm;
    }
}