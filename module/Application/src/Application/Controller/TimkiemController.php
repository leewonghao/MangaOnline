<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * TimkiemController
 *
 * @author
 *
 * @version
 *
 */
class TimkiemController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated TimkiemController::indexAction() default action
       $id_search = $this->getRequest()->getPost('search');
        if(!$id_search)
            $this->redirect()->toRoute('home');
        $DS_Truyen = $this->Get_table()->TimkiemTruyen($id_search);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Tìm kiếm truyện ' . $id_search);
        return new ViewModel(array(
            'DS_truyen' => $DS_Truyen,
        	'id_search' => $id_search,
        ));
    }
    
    function Get_table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm; 
    }
}