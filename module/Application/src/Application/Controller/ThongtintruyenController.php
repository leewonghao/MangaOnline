<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ThongtintruyenController
 *
 * @author
 *
 * @version
 *
 */
class ThongtintruyenController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated ThongtintruyenController::indexAction() default action
        $id = $this->params()->fromRoute('id', 0);
        if(!$id){
            $this->redirect()->toRoute('home');
        }
        $TT_truyen = $this->Get_Table()->LayThongtintruyen($id);
        $TL_truyen = $this->Get_Table()->LayDSTheLoai($id);
        $Chap_TT = $this->Get_Table()->LayDSChaptertruyen($id);
        $CungTL_truyen = $this->Get_Table()->TruyencungTL($id);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Thông tin truyện online '.$TT_truyen->Tentruyen);
        return new ViewModel(array(
        	'TT_truyen' => $TT_truyen,
            'TL_truyen' => $TL_truyen,
            'Chap_TT' => $Chap_TT,
            'Listcungtltruyen' => $CungTL_truyen,
        ));
    }
    
    function  Get_Table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm;
    }
}