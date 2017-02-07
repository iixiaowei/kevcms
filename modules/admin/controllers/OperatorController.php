<?php
namespace app\modules\admin\controllers;
use app\modules\admin\components\BaseController;
use app\components\Util;
use app\models;

class OperatorController extends BaseController{
    public $enableCsrfValidation = false;
    
    public function actionList(){
        $this->initFocus('sys', 'sys_operator');
        parent::init();

        $model = new models\TblRole();
        $roles = $model->find()->where(['is_valid'=>1])->orderBy("sort_by desc")->all();

        return $this->render('list',compact('roles'));
    }

    public function actionListData(){
        $request = \Yii::$app->request;
        $iDisplayLength  = $request->get('iDisplayLength');
        $sEcho           = $request->get('sEcho');
        $sSearch         = $request->get('sSearch');
        $iDisplayStart   = $request->get('iDisplayStart');
        //iSortCol_0=1&sSortDir_0=asc
        $iSortCol        = $request->get('iSortCol_0');
        $sSortDir        = $request->get('sSortDir_0');

        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'name',  'dt' => 1 ),
            array( 'db' => 'role_name',     'dt' => 2 ),
            array( 'db' => 'last_logintime',     'dt' => 3),
            array( 'db' => 'last_loginip',     'dt' => 4),
            array( 'db' => 'is_valid',     'dt' => 5),
            array( 'db' => 'rtime',     'dt' => 6),
            array( 'db' => 'opt_str',     'dt' => 7)
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
            $where.=" AND ( name like '%".$sSearch."%' or is_valid =".$sIsValid." or rtime like '%".$sSearch."%' or id like '%".$sSearch."%' )";
        }

        $sql = "select count(id) as nums from {{%tbl_operator}} $where ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $iTotalRecords = $cmd->queryScalar();

        $sEcho = $sEcho+1;
        $iTotalRecords = $iTotalRecords;
        $iTotalDisplayRecords = $iDisplayLength;


        $sql = "select id,name,is_valid,FROM_UNIXTIME(last_logintime,'%Y-%m-%d %H:%i:%s') AS last_logintime,last_loginip,role_id,FROM_UNIXTIME(rtime,'%Y-%m-%d %H:%i:%s') AS rtime from {{%tbl_operator}} $where $order limit $iDisplayStart,$iTotalDisplayRecords  ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $rs = $cmd->queryAll();

        $res = array();
        $i=0;
        foreach ($rs as $r){
            $res[$i]['id']=$r['id'];
            $res[$i]['name']=$r['name'];
            $isvalid=$r['is_valid']==1?"<span class=\"label label-success\">有效</span>":"<span class=\"label label-default\">无效</span>";
            $res[$i]['is_valid']= $isvalid;
            $res[$i]['role_name']= Util::getRoleNameById( $r['role_id'] );
            $res[$i]['last_logintime']=$r['last_logintime'];
            $res[$i]['last_loginip']=$r['last_loginip'];
            $res[$i]['rtime']=$r['rtime'];
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

    public function actionSave(){
        $id   = \Yii::$app->request->post('id');
        $name = \Yii::$app->request->post('name');
        $role_id = \Yii::$app->request->post('role_id');
        $is_valid = \Yii::$app->request->post('is_valid');

        $model =new models\Operator();
        
        
        if (intval($id)>0){
            $cnt = $model->find()->where("name=:name and id!=:id",[':name'=>$name,':id'=>$id])->count();
            if ($cnt>0){
                echo json_encode(['errorMsg'=>'操作员名称已经存在']);
            }else{
                $opt = models\Operator::findOne($id);
                $opt->name=$name;
                $opt->role_id=$role_id;
                $opt->is_valid=$is_valid;
                $opt->mtime=time();
                $opt->update();        
                echo json_encode(['errorMsg'=>false]);
            }
            
            exit;
        }
       
        $cnt = $model->find()->where(['name'=>$name])->count();
        if ($cnt>0){
            echo json_encode(['errorMsg'=>'操作员名称已经存在']);
        }else{
            $model->name=$name;
            $model->role_id = $role_id;
            $model->is_valid=$is_valid;
            $model->rtime = time();
            $model->mtime = time();
            $model->password = md5('123456');
            $res = $model->save(false);
            echo json_encode(['errorMsg'=>false]);
        }
    }
    
    public function actionGetInfo(){
        $id = \Yii::$app->request->post('id');
        $result = models\Operator::find()->asArray()->where(['id'=>$id])->one();
        echo json_encode(['row'=>$result]);
    }
    
    public function actionDelete(){
        $id = \Yii::$app->request->post('id');
        $opt = models\Operator::findOne($id);
        $opt->delete();        
        echo json_encode(['status'=>1]);
    }

}

?>