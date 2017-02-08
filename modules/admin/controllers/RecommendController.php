<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\BaseController;
use app\models;
use app\components\Util;
class RecommendController extends BaseController
{
    public $enableCsrfValidation = false;
    public $_request;
    
    public function init(){
        $this->_request = \Yii::$app->request;
    }
    
    public function actionList(){
        $this->initFocus('article', 'article_recommend');
        parent::init();
        
        $categorys = \Yii::$app->db->createCommand("select id,name from tbl_category where is_valid=1")->queryAll();
        
        return $this->render('list',compact('categorys'));
    }
    
    public function actionListData(){
        $iDisplayLength  = $this->_request->get('iDisplayLength');
        $sEcho           = $this->_request->get('sEcho');
        $sSearch         = $this->_request->get('sSearch');
        $iDisplayStart   = $this->_request->get('iDisplayStart');
        //iSortCol_0=1&sSortDir_0=asc
        $iSortCol        = $this->_request->get('iSortCol_0');
        $sSortDir        = $this->_request->get('sSortDir_0');
    
        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'name',  'dt' => 1 ),
            array( 'db' => 'category_name',     'dt' => 2 ),
            array( 'db' => 'sort_by',     'dt' => 3),
            array( 'db' => 'is_valid',     'dt' => 4),
            array( 'db' => 'create_at',     'dt' => 5),
            array( 'db' => 'opt_str',     'dt' => 6)
        );
    
        $sortCol = $columns[$iSortCol]['db'];
        $order = " ORDER BY $sortCol  $sSortDir";
    
        if($sSearch=="有效"){
            $sIsValid = 1;
        }elseif($sSearch=="无效"){
            $sIsValid = 0;
        }else{
            $sIsValid = "100";
        }
    
        $where=" where 1=1 ";
        if ($sSearch!=""){
            $where.=" AND ( name like '%".$sSearch."%' or is_valid =".$sIsValid." or create_at like '%".$sSearch."%' or id like '%".$sSearch."%' )";
        }
    
        $sql = "select count(id) as nums from {{%tbl_recommend}} $where ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $iTotalRecords = $cmd->queryScalar();
    
        $sEcho = $sEcho+1;
        $iTotalRecords = $iTotalRecords;
        $iTotalDisplayRecords = $iDisplayLength;
    
    
        $sql = "select id,name,is_valid,FROM_UNIXTIME(create_at,'%Y-%m-%d %H:%i:%s') AS create_at,sort_by,category_id from {{%tbl_recommend}} $where $order limit $iDisplayStart,$iTotalDisplayRecords  ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $rs = $cmd->queryAll();
    
        $res = array();
        $i=0;
        foreach ($rs as $r){
            $res[$i]['id']=$r['id'];
            $res[$i]['name']=$r['name'];
            $isvalid=$r['is_valid']==1?"<span class=\"label label-success\">有效</span>":"<span class=\"label label-default\">无效</span>";
            $res[$i]['is_valid']= $isvalid;
            $res[$i]['category_name']= $r['category_id'];
            $res[$i]['create_at']=$r['create_at'];
            $res[$i]['sort_by']=$r['sort_by'];
            $optStr = "<a class=\"btn btn-info btn-xs\" href=\"javascript:void(0);\" onclick=\"EditRole(".$r['id'].");\">编辑</a>&nbsp;";
            $optStr.="<a class=\"btn btn-danger btn-xs\" href=\"javascript:void(0);\" onclick=\"checkDel(".$r['id'].");\">删除</a>";
            $res[$i]['opt_str']=$optStr;
            $i++;
        }
        unset($rs);
        echo json_encode(array(
            'sEcho'=>$sEcho,
            'iTotalRecords'=>$iTotalDisplayRecords,
            'iTotalDisplayRecords'=> $iTotalRecords,
            'aaData'=>$res
        ));
    }
    
    public function __destruct(){
        unset($this->_request);
    }
    
}

?>