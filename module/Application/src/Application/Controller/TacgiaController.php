<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * TacgiaController
 *
 * @author
 *
 * @version
 *
 */
class TacgiaController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated TacgiaController::indexAction() default action
        $id = $this->params()->fromRoute('id');
        if(!$id)
            $this->redirect()->toRoute('home');
        $DS_Truyen = $this->Get_Table()->TimkiemTacgia($id)->setCurrentPageNumber($this->params()->fromRoute('page'));
        $DS_Truyen->setItemCountPerPage(20);
        $Tentg = $this->Get_Table()->LayTentacgia_truyen($id);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện theo tác giả '.$Tentg->Tentacgia);
        return new ViewModel(array(
            'DS_truyen' => $DS_Truyen,
        	'id_search' => $id,
            'Tentg' => $Tentg,
        ));
    }
    
    function Get_Table(){
    	$sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
    	return $sm;
    }
}