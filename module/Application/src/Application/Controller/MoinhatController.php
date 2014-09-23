<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * MoinhatController
 *
 * @author
 *
 * @version
 *
 */
class MoinhatController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated MoinhatController::indexAction() default action
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Danh sách truyện mới nhất');
        $paginator = $this->Get_Table()->LayDanhSachChapterMoiNhat();
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