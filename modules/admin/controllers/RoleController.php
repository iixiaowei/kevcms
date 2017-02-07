<?php
namespace app\modules\admin\controllers;
use app\modules\admin\components\BaseController;
use app\components\Util;
use app\models\TblRole;
use app\models;
use yii\helpers\Url;
use yii\base\Object;
class RoleController extends BaseController{
  public $enableCsrfValidation = false;
    
  public function actionList(){
     $this->initFocus('sys', 'sys_role');
     parent::init();
     
     //$sql = "SELECT * FROM {{%tbl_role}} ORDER BY sort_by DESC";
     //$cmd = \Yii::$app->db->createCommand($sql);
     //$lists = $cmd->queryAll();
     $lists = array();    
        
    return $this->render('list',['lists'=>$lists]);            
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
            array( 'db' => 'is_valid',     'dt' => 2 ),
            array( 'db' => 'description',     'dt' => 3),
            array( 'db' => 'sort_by',     'dt' => 4),
            array( 'db' => 'rtime',     'dt' => 5),
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
            $where.=" AND ( name like '%".$sSearch."%' or is_valid =".$sIsValid." or rtime like '%".$sSearch."%' or description like '%".$sSearch."%' or id like '%".$sSearch."%' )";
        }

        $sql = "select count(id) as nums from {{%tbl_role}} $where ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $iTotalRecords = $cmd->queryScalar();

        $sEcho = $sEcho+1;
        $iTotalRecords = $iTotalRecords;
        $iTotalDisplayRecords = $iDisplayLength;


        $sql = "select id,name,is_valid,description,sort_by,FROM_UNIXTIME(rtime,'%Y-%m-%d %H:%i:%s') AS rtime from {{%tbl_role}} $where $order limit $iDisplayStart,$iTotalDisplayRecords  ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $rs = $cmd->queryAll();

        $res = array();
        $i=0;
        foreach ($rs as $r){
            $res[$i]['id']=$r['id'];
            $res[$i]['name']=$r['name'];
            $isvalid=$r['is_valid']==1?"<span class=\"label label-success\">有效</span>":"<span class=\"label label-default\">无效</span>";
            $res[$i]['is_valid']= $isvalid;
            $res[$i]['description']=$r['description'];
            $res[$i]['sort_by']=$r['sort_by'];
            $res[$i]['rtime']=$r['rtime'];
            $optStr = "<a class=\"btn btn-info btn-xs\" href=\"javascript:void(0);\" onclick=\"EditRole(".$r['id'].");\">编辑</a>&nbsp;";
            $optStr.="<a class=\"btn btn-success btn-xs\" href=".Url::toRoute(['/admin/role/setright', 'id' => $r['id']]).">栏目权限设置</a>&nbsp;";
            //$optStr.="<a class=\"btn bg-color-blueDark txt-color-white btn-xs\" href=".Url::toRoute(['/admin/role/setright_action', 'id' => $r['id']]).">操作权限设置</a>&nbsp;";
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
  
  public function actionAdd()
  {
   
    return $this->renderPartial('add');
  }
  
  public function actionDoAdd(){
    $name        = \Yii::$app->request->post('name');
    $description = \Yii::$app->request->post('description');
    $listorder   = \Yii::$app->request->post('listorder');
    $is_valid    = \Yii::$app->request->post('is_valid');
    
    $cmd = \Yii::$app->db->createCommand();
    $cmd->insert('tbl_role',[
       'name'=>$name,
       'is_valid'=>$is_valid,
       'description'=>$description,
       'sort_by'=>$listorder,
       'rtime'=>time(),
       'mtime'=>time()
      ]
      )->execute();
    
    $logSql = $cmd->getRawSql();
    //log
    $actionName = \Yii::$app->controller->id;
    $methodName = \Yii::$app->controller->action->id;
    $moduleName = \Yii::$app->controller->module->id;
    Util::saveLog($moduleName, $actionName, $methodName, $logSql);
     
    echo json_encode(['status'=>1,'msg'=>'操作成功']);
  }
  
  public function actionEdit(){
    $id = \Yii::$app->request->get('id');
    $model = new TblRole();
    $row = $model->findOne($id);
    
    return $this->renderPartial('edit',compact('row'));
  }
  
  
  public function actionDoEdit(){
    $id          = \Yii::$app->request->post('editid');
    $name        = \Yii::$app->request->post('name');
    $description = \Yii::$app->request->post('description');
    $listorder   = \Yii::$app->request->post('listorder');
    $is_valid    = \Yii::$app->request->post('is_valid');
    
    $cmd = \Yii::$app->db->createCommand();
    $cmd->update('tbl_role',[
       'name'=>$name,
       'is_valid'=>$is_valid,
       'description'=>$description,
       'sort_by'=>$listorder,
       'mtime'=>time()
      ],"id=:id",[":id"=>$id])->execute();
    
    $logSql = $cmd->getRawSql();
    //log
    $actionName = \Yii::$app->controller->id;
    $methodName = \Yii::$app->controller->action->id;
    $moduleName = \Yii::$app->controller->module->id;
    Util::saveLog($moduleName, $actionName, $methodName, $logSql);
     
    echo json_encode(['status'=>1,'msg'=>'操作成功']);
  }
  
  public function actionDelete(){
        $id = \Yii::$app->request->get('id');
        if(intval($id)<=0){
            return $this->redirect(   Url::toRoute(['default/error','active'=>'sys','focus'=>'sys_menu','message'=> '非法操作','jumpUrl'=>urlencode('/admin/role/list')]) );
            exit;
        }

        $role = models\TblRole::findOne($id);

        if(empty($role)){
            return $this->redirect(   Url::toRoute(['default/error','active'=>'sys','focus'=>'sys_menu','message'=> '记录不存在','jumpUrl'=>urlencode('/admin/role/list')]) );
            exit;
        }

        if($role->delete()){
            $actionName = \Yii::$app->controller->id;
            $methodName = \Yii::$app->controller->action->id;
            $moduleName = \Yii::$app->controller->module->id;
            Util::saveLog($moduleName, $actionName, $methodName, $role->toArray());
            return $this->redirect(   Url::toRoute(['default/success','active'=>'sys','focus'=>'sys_menu','message'=> '操作成功','jumpUrl'=>urlencode('/admin/role/list')]) );
            exit;
        }else{
            return $this->redirect(   Url::toRoute(['default/error','active'=>'sys','focus'=>'sys_menu','message'=> '操作失败','jumpUrl'=>urlencode('/admin/role/list')]) );
            exit;
        }
  }
  
  public function actionSetright(){
    $this->initFocus('sys', 'sys_role');
    parent::init();
    $id = \Yii::$app->request->get('id');
    
    return $this->render('setright',compact('id'));
  }
  
  public function actionGetRightlists(){
      $model = new models\TblMenu();
      $roleid = \Yii::$app->request->get('id');
      $rightArr = array();
      
      $roleright = new models\TblRoleright();
      $rs = $roleright->findOne(['role_id'=>$roleid]);
      $right_ids = $rs['right_ids'];
      $ids_arr = explode(",", $right_ids);
      foreach ($ids_arr as $id){
          if(!empty($id)){
              array_push($rightArr, $id);
          }
      }
      
      $treeData = $model->getMenuTree(0,$rightArr);
      echo json_encode($treeData);      
  }
  
  public function actionDoSetright(){
      $ids = \Yii::$app->request->post('ids');
      $roleid = \Yii::$app->request->post('roleid');
      $old_ids = "";
      
      
      $status = "";
      $msg    = "";
      if ($roleid==1){
          $status=1;
          $msg   ='操作成功';
          
      }else{
          $model = new models\TblRoleright();
          $cnt = $model->find()
                       ->where(['role_id'=>$roleid])->count();
          if ($cnt>0){
              $rs = $model->find()->where(['role_id'=>$roleid])->one();
              $old_ids = $rs->right_ids;
              $rs->right_ids = $ids;
              $rs->update();      
              $status=1;
              $msg   ='操作成功';
          }else{
              $model->role_id = $roleid;
              $model->right_ids = $ids;
              $model->insert();
              $status=1;
              $msg   ='操作成功';
          }
      }
      
      //log
      $actionName = \Yii::$app->controller->id;
      $methodName = \Yii::$app->controller->action->id;
      $moduleName = \Yii::$app->controller->module->id;
      Util::saveLog($moduleName, $actionName, $methodName, "角色[$roleid]权限设置新值:$ids 权限设置旧值:$old_ids");
      echo json_encode(['status'=>$status,'msg'=>$msg]);
  }
  
  
}    
?>