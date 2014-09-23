<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * DecuController
 *
 * @author
 *
 * @version
 *
 */
class DecuController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated DecuController::indexAction() default action
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện đề cử');
        $paginator = $this->Get_Table()->DanhsachDecu();
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(20);
        return new ViewModel(array(
        	'list_truyen' => $paginator,
        ));
    }
    
    public function  Get_Table(){
    	$sm = $this->getServiceLocator();
    	$table = $sm->get('Application\Model\ApplicationTable');
    	return  $table;
    }
}