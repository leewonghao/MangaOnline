<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ViewtruyenController
 *
 * @author
 *
 * @version
 *
 */
class ViewtruyenController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        // TODO Auto-generated ViewtruyenController::indexAction() default action
        $id = $this->params()->fromRoute('id', 0);
        if(!$id)
            $this->redirect()->toRoute('home');
        $TT_Chap = $this->Get_table()->ThongtinChapter($id);
        $DS_Chap = $this->Get_table()->DanhsachChapterView($id);
        $DS_Chap_duoi = $this->Get_table()->DanhsachChapterView($id);
        $View_Chap = $this->Get_table()->View_truyen($id);
        $DSNext_Prev = $this->Get_table()->DanhsachNext_Previous_View($id);
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Đọc truyện online '. $TT_Chap->Tentruyen.' - '.$TT_Chap->Tenchapter);
        return new ViewModel(array(
        	'TT_Chapter' => $TT_Chap,
            'DS_Chapter' => $DS_Chap,
            'View_Chapter' => $View_Chap,
            'DSNext_Prev' => $DSNext_Prev,
            'DS_Chap_duoi' => $DS_Chap_duoi,
        ));
    }
    
    function Get_table(){
        $sm = $this->getServiceLocator()->get('Application\Model\ApplicationTable');
        return $sm;
    }
}