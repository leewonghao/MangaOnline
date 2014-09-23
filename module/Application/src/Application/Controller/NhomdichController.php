<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * NhomdichController
 *
 * @author
 *
 * @version
 *
 */
class NhomdichController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated NhomdichController::indexAction() default action
            $id = $this->params()->fromRoute('id');
        if(!$id)
            $this->redirect()->toRoute('home');
        $DS_Truyen = $this->Get_Table()->TimkiemNhomdich($id)->setCurrentPageNumber($this->params()->fromRoute('page'));
        $DS_Truyen->setItemCountPerPage(20);
        $Tennhom = $this->Get_Table()->LayTennhom_truyen($id);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện theo nhóm dịch '.$Tennhom->Nhomdich);
        return new ViewModel(array(
            'DS_truyen' => $DS_Truyen,
        	'id_search' => $id,
            'Tennhom' => $Tennhom,
        ));
    }
    
    function Get_Table(){
    	$sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
    	return $sm;
    }
}