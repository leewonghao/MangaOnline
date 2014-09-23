<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
class ApplicationTable
{
    protected $adapter;
    
    public function __construct($adapter){
        $this->adapter = $adapter;
    }
    
    public function TruyenDacSac(){
        $result = $this->adapter->query('select Hinhminhhoa, Tentruyen, Matruyen, slugify(Tentruyenkhongdau) Tentruyenkhongdau
                                            from truyentranh tr
                                                where tr.dacsac = 1', Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function LayDanhSachChapterMoiNhat(){        
        $select = new Select();
        $select->from(array('tr' => 'truyentranh'));
        $select->join(array('new_chap' => 'chaptermoinhat'), 'new_chap.Matruyen = tr.Matruyen', array());
        $select->join(array('chap' => 'chaptertruyen'), 'new_chap.Machapter = chap.Machapter', array('Tenchapter', 'Ngaydang', 'Machapter', 'Tenchapterkhongdau' => new Expression('slugify(Tenchapterkhongdau)')));
        $select->columns(array('Matruyen', 'Hinhminhhoa', 'Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
        $select->order('chap.Ngaydang desc');
 
        $paginator = new Paginator(new DbSelect($select, $this->adapter));
        return $paginator;
    }
    
    public function LayDanhSachChapterMoiNhat_Index(){
    	$result = $this->adapter->query('select Hinhminhhoa, Tentruyen, slugify(Tentruyenkhongdau) Tentruyenkhongdau,
    	                                    tr.Matruyen, Tenchapter, chap.Ngaydang, slugify(Tenchapterkhongdau) Tenchapterkhongdau, new_chap.Machapter
                                            from truyentranh tr, chaptertruyen chap, chaptermoinhat new_chap
                                            where tr.matruyen = new_chap.matruyen and chap.machapter = new_chap.machapter
                                            order by chap.ngaydang desc
                                            limit 0, 10',Adapter::QUERY_MODE_EXECUTE);
    	return $result;
    }
    
    public function  LayThongtintruyen($id){
        $result = $this->adapter->query('select tg.Tentacgia, slugify(tg.Tentacgiakhongdau) Tentacgiakhongdau, tg.Matacgia, slugify(tr.Tentruyenkhongdau) Tentruyenkhongdau, 
                                             Nhomdichkhongdauslug, tr.Nhomdich, tr.Tentruyen, tl.Maloai, tr.Matruyen, tr.Cottruyen, (if(tr.NhaXB is null,"Chưa biết",tr.NhaXB)) NhaXB, tl.Tenloai, slugify(loaitruyenkhongdau) Loaitruyenkhongdau, case tr.Tinhtrang when 0 then "Đang cập nhật" else "Hoàn thành" end as "Tinhtrang", tr.Hinhminhhoa
                                    from tacgia tg, chitiettheloai cttl, truyentranh tr, loaitruyen tl
                                    where tg.matacgia = tr.matacgia and cttl.matruyen = tr.matruyen and cttl.maloai = tl.maloai
                                    and tr.matruyen = ' . $id, Adapter::QUERY_MODE_EXECUTE);
        return $result->current();
    }
    
    public function LayDSTheLoai($id){
        $result = $this->adapter->query('select  tl.Maloai, tl.Tenloai, slugify(loaitruyenkhongdau) Loaitruyenkhongdau
                                    from  chitiettheloai cttl, truyentranh tr, loaitruyen tl
                                    where cttl.matruyen = tr.matruyen and cttl.maloai = tl.maloai
                                    and tr.matruyen = ' . $id, Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function LayDSChaptertruyen($id){        
	    
        $result = $this->adapter->query('select chap.Machapter, chap.Tenchapter, chap.Ngaydang, slugify(chap.Tenchapterkhongdau) Tenchapterkhongdau, Soluotxem
									from chaptertruyen chap
									where chap.matruyen='.$id.
                                     ' order by ngaydang desc', Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    public function TruyencungTL($id){
        $result = $this->adapter->query('SELECT tr.Matruyen, tr.Tentruyen, new_chap.Machapter, chap.Tenchapter, slugify(Tentruyenkhongdau) Tentruyenkhongdau, slugify(Tenchapterkhongdau) Tenchapterkhongdau
										FROM truyentranh tr, loaitruyen tl, chitiettheloai cttl,
											chaptertruyen chap, chaptermoinhat new_chap
										WHERE tr.matruyen = cttl.matruyen and cttl.maloai = tl.maloai and new_chap.matruyen = tr.matruyen and chap.machapter = new_chap.machapter
										AND tl.maloai
										IN (
										SELECT lt.maloai
										FROM loaitruyen lt, truyentranh tr, chitiettheloai cttl
										WHERE lt.maloai = cttl.maloai
										AND tr.matruyen = cttl.matruyen
										AND tr.matruyen = '. $id .'
										)
										AND tr.matruyen != '. $id .'
										ORDER BY RAND( ) 
										LIMIT 0 , 10', Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function View_truyen($id){
        $result = $this->adapter->query('SELECT ct.Hinhanh
										  FROM chitietchapter ct, chaptertruyen chap
										    WHERE ct.machapter = chap.machapter and chap.machapter = '.$id, Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function ThongtinChapter($id){
        $result = $this->adapter->query('select Tenchapter, Tentruyen, Machapter, slugify(Tenchapterkhongdau) Tenchapterkhongdau
										  from chaptertruyen chap, truyentranh tr
										     where chap.matruyen = tr.matruyen and chap.machapter ='.$id, Adapter::QUERY_MODE_EXECUTE);
        return $result->current();
    }
    
    public function DanhsachChapterView($id){
        $result = $this->adapter->query('SELECT chap.Machapter, chap.Tenchapter, slugify(chap.tenchapterkhongdau) Tenchapterkhongdau
													FROM chaptertruyen chap, truyentranh tr
													WHERE tr.matruyen = chap.matruyen
													AND tr.matruyen = ( 
													SELECT sub_tr.matruyen
													FROM truyentranh sub_tr, chaptertruyen sub_chap
													WHERE sub_tr.matruyen = sub_chap.matruyen
													AND sub_chap.machapter ='.$id.' ) 
													AND chap.machapter <> ' . $id, Adapter::QUERY_MODE_EXECUTE); 
        return $result;
    }
    
    public function  DanhsachNext_Previous_View($id){
        $result = $this->adapter->query('select 1 rank, Machapter, slugify(Tenchapterkhongdau) Tenchapkhongdau from chaptertruyen where Machapter = (select max(Machapter)
                                             from chaptertruyen where Machapter < ' . $id . ') and Matruyen = 
                                             (select Matruyen from chaptertruyen where Machapter = ' . $id . ')
                                             union all
                                             select 2, Machapter, slugify(Tenchapterkhongdau) from chaptertruyen 
                                             where Machapter = (select min(Machapter) from chaptertruyen where Machapter > ' . $id . ') and
                                             Matruyen = (select Matruyen from chaptertruyen where Machapter = ' . $id . ')', Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function DanhsachTL(){
        $result = $this->adapter->query('SELECT Maloai, Tenloai, slugify(loaitruyenkhongdau) Loaitruyenkhongdau
                                            FROM loaitruyen
                                            WHERE Maloai NOT 
                                            IN ( SELECT maloai
                                                    FROM loaitruyen
                                                    WHERE maloai
                                                    BETWEEN 11 
                                                    AND 15)', Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    
    public function Danhsachtruyen(){
        $select = new Select();
        $select->from(array('tr' => 'truyentranh'))->join(array('tg' => 'tacgia'), 'tg.matacgia = tr.matacgia', array('Tentacgia'));
    	$select->join(array('new_chap' => 'chaptermoinhat'), 'new_chap.Matruyen = tr.Matruyen', array());
    	$select->join(array('chap' => 'chaptertruyen'), 'new_chap.Machapter = chap.Machapter', array('Tenchapter', 'Ngaydang', 'Machapter', 'Tenchapterkhongdau' => new Expression('slugify(Tenchapterkhongdau)')));
        $select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Matruyen', 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
        $select->order('tentruyen asc');
        
        $paginator = new Paginator(new DbSelect($select, $this->adapter));
        return $paginator;
    }
    
    public function Danhsachtruyen_TheLoai($id){
    	$select = new Select();
    	$select->from(array('tr' => 'truyentranh'));
    	$select->join(array('new_chap' => 'chaptermoinhat'), 'new_chap.Matruyen = tr.Matruyen', array());
    	$select->join(array('chap' => 'chaptertruyen'), 'new_chap.Machapter = chap.Machapter', array('Tenchapter', 'Ngaydang', 'Machapter', 'Tenchapterkhongdau' => new Expression('slugify(Tenchapterkhongdau)')));
    	$select->join(array('cttl' => 'chitiettheloai'), 'cttl.Matruyen = new_chap.Matruyen', array());
    	$select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Matruyen', 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
    	$select->where(array('Maloai' => $id))->order('tentruyen asc');
    	
    	$paginator = new Paginator(new DbSelect($select, $this->adapter));
    	return $paginator;
    }
    
    public function TenTL($id){
        $result = $this->adapter->query('select Tenloai
                                            from loaitruyen tl
                                            where tl.Maloai ='.$id, Adapter::QUERY_MODE_EXECUTE);
        return $result->current();
    }
    
    public function DanhsachChapterXemnhieu(){
        $sub_select = new Select();
        $sub_select->from('chaptertruyen')->group('matruyen')->columns(array('Soluotxem' => new Expression('max(soluotxem)'), 'Matruyen', 'Machapter', 'Tenchapter', 'Ngaydang', 'Tenchapterkhongdau'));
        
    	$select = new Select();
    	$select->from(array('tr' => 'truyentranh'));
    	$select->join(array('chap' => $sub_select), 'tr.matruyen = chap.matruyen', array('Machapter', 'Tenchapter', 'Ngaydang', 'Tenchapterkhongdau' => new Expression('slugify(Tenchapterkhongdau)')));
    	$select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Matruyen', 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
    	$select->order('chap.Soluotxem desc');
    	
    	$paginator = new Paginator(new DbSelect($select, $this->adapter));
    	return $paginator;
    }
    
    public function DanhsachDecu(){    
    	$select = new Select();
    	$select->from(array('tr' => 'truyentranh'))->join(array('tg' => 'tacgia'), 'tg.matacgia = tr.matacgia', array('Tentacgia'));
        $select->join(array('new_chap' => 'chaptermoinhat'), 'new_chap.Matruyen = tr.Matruyen', array());
        $select->join(array('chap' => 'chaptertruyen'), 'new_chap.Machapter = chap.Machapter', array('Tenchapter', 'Ngaydang', 'Machapter', 'Tenchapterkhongdau' => new Expression('slugify(Tenchapterkhongdau)')));
    	$select->columns(array('Tentruyen', 'Matruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
    	$select->order('tr.Soluotthich desc');
    	 
    	$paginator = new Paginator(new DbSelect($select, $this->adapter));
    	return $paginator;
    }
    
    public function DanhsachDecu_Index(){
    	$result = $this->adapter->query('select Hinhminhhoa, Tentruyen, slugify(Tentruyenkhongdau) Tentruyenkhongdau,
    	                                    tr.Matruyen, Tenchapter, chap.Ngaydang, slugify(Tenchapterkhongdau) Tenchapterkhongdau, new_chap.Machapter
                                            from truyentranh tr, chaptertruyen chap, chaptermoinhat new_chap
                                            where tr.matruyen = new_chap.matruyen and chap.machapter = new_chap.machapter
                                            order by tr.soluotthich desc
                                            limit 0, 10',Adapter::QUERY_MODE_EXECUTE);
    	return $result;
    }
    
    public function TimkiemTruyen($msg){
        $select = new Select();
        $select->from(array('tr' => 'truyentranh'))->join(array('tg' => 'tacgia'), 'tg.Matacgia = tr.Matacgia', array('Tentacgia'));
        $select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Ngaydang', 'Matruyen', 'Nhomdich' => new Expression("Case when Nhomdich Is null then 'Chưa biết' else Nhomdich End"), 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
        $select->where('Match(Tentruyen, Tentruyenkhongdau) Against("'.$msg.'*" in boolean mode)');
       
        $sql = new Sql($this->adapter);
        $sqlstring = $sql->getSqlStringForSqlObject($select);
        $result = $this->adapter->query($sqlstring, Adapter::QUERY_MODE_EXECUTE);
        return $result;
    }
    public function TimkiemTacgia($msg){
        $select = new Select();
        $select->from(array('tr' => 'truyentranh'))->join(array('tg' => 'tacgia'), 'tr.matacgia = tg.matacgia', array('Tentacgia',  'Tentacgiakhongdau' => new Expression('slugify(Tentacgiakhongdau)')));
        $select->where(array('tr.matacgia' => $msg));
        $select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Matruyen', 'Nhomdich', 'Ngaydang', 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
        
        $paginator = new Paginator(new DbSelect($select, $this->adapter));
        return $paginator;
    }
    public function TimkiemNhomdich($msg){
    	$select = new Select();
    	$select->from(array('tr' => 'truyentranh'))->join(array('tg' => 'tacgia'), 'tr.matacgia = tg.matacgia', array('Tentacgia'));
    	$select->where("tr.nhomdichkhongdauslug = '". $msg ."'");
    	$select->columns(array('Tentruyen', 'Tentruyenkhongdau' => new Expression('slugify(Tentruyenkhongdau)'), 'Matruyen', 'Nhomdich', 'Ngaydang', 'Tinhtrang' => new Expression("case tinhtrang when 0 then 'Cập nhật' else 'Hoàn thành' end")));
    
    	$paginator = new Paginator(new DbSelect($select, $this->adapter));
    	return $paginator;
    }
    public function LayTentacgia_truyen($msg){
        $result = $this->adapter->query('select Tentacgia from tacgia where matacgia = ' . $msg, Adapter::QUERY_MODE_EXECUTE);
        return $result->current();
    }
    public function LayTennhom_truyen($msg){
    	$result = $this->adapter->query("select Nhomdich from truyentranh where nhomdichkhongdauslug = '" . $msg ."'", Adapter::QUERY_MODE_EXECUTE);
    	return $result->current();
    }
}