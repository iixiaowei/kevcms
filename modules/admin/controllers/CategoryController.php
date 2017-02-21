<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\BaseController;
use app\components\Tree;
use app\components\Util;
use yii\helpers\Url;
use app\models\Category;
use yii\base\Object;
class CategoryController extends BaseController{
    public $enableCsrfValidation = false;
    public $_request;
    
    public function init(){
        $this->_request = \Yii::$app->request;
    }
    
    public function actionList()
    {
        $this->initFocus('article', 'article_list');
        parent::init();
        
        $tree = new Tree ();
        $tree->icon = array(
            '&nbsp;&nbsp;&nbsp;│ ',
            '&nbsp;&nbsp;&nbsp;├─ ',
            '&nbsp;&nbsp;&nbsp;└─ '
        );
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        
        $sql = "select * from {{%tbl_category}} order by sort_by asc,id desc";
        $cmd = \Yii::$app->db->createCommand($sql);
        $result = $cmd->queryAll();
        
        //Log
        $actionName = \Yii::$app->controller->id;
        $methodName = \Yii::$app->controller->action->id;
        $moduleName = \Yii::$app->controller->module->id;
        Util::saveLog($moduleName, $actionName, $methodName, $cmd->getSql());
        
        $array = array();
        foreach ($result as $r) {
            $r ['cname'] = $r ['name'];
            $r ['listorder'] = $r['sort_by'];
            $r ['create_at'] = date('Y-m-d H:i:s',$r['create_at']);
            $r ['is_valid'] = $r['is_valid']==1?"<span class=\"label label-success\">有效</span>":"<span class=\"label label-default\">无效</span>";
            $r ['str_manage'] = "<a class=\"btn btn-success btn-xs\"  href='javascript:void(0);' onclick='sDialog(".$r["id"].")'>添加子栏目</a>";
            $r ['str_manage'] .= "  <a class=\"btn btn-info btn-xs\"  href='javascript:void(0);' onclick='showDialog(".$r["id"].")'>修改</a>";
            $r ['str_manage'] .= "  <a class=\"btn btn-danger btn-xs\" href='javascript:void(0);' onclick='checkDel(" . $r ['id'] . ")'>删除</a>";
            $array [] = $r;
        }
        
        $str = "<tr>
					<td align='center' style='text-align:center;'><label class='position-relative'><input name='listorders[\$id]' value='\$listorder' type='checkbox' class='ace'><span class='lbl'></span></label></td>
					<td align='center'>\$id</td>
					<td >\$spacer\$cname</td>
					<td align='center'>\$listorder</td>
					<td align='center'>\$is_valid</td>
					<td align='center'>\$create_at</td>
					<td align='left'>\$str_manage</td>
				</tr>";
        $tree->init($array);
        $categorys = $tree->get_tree(0, $str);
        
        $tree = new Tree ();
        
        $sql = "select * from {{%tbl_category}} order by sort_by asc,id desc";
        $cmd = \Yii::$app->db->createCommand($sql);
        $result = $cmd->queryAll();
        $array = array();
        foreach ($result as $r) {
            $r ['cname'] = $r ['name'];
            $r ['selected'] = '';
            $array [] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$cname</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0, $str);
        
        return $this->render('list',[
            'categorys' => $categorys,
            'select_categorys'=>$select_categorys
        ]);
    }
    
    public function actionSave(){
        $id  = $this->_request->post('id');
        $name = $this->_request->post('name');
        $parentid = $this->_request->post('parentid');
        $sort_by  = $this->_request->post('sort_by');
        $is_valid = $this->_request->post('is_valid');
        
        $category = new Category();
        
        if(intval($id)>0){
            $cate = Category::findOne($id);
            $cate->name=$name;
            $cate->parentid=$parentid;
            $cate->is_valid=$is_valid;
            $cate->sort_by=$sort_by;
            $cate->update_at = time();
            $cate->update();
            echo json_encode(['errorMsg'=>false]);
            exit();
        }
        
        $category->name = $name;
        $category->parentid = $parentid;
        $category->sort_by = $sort_by;
        $category->is_valid = $is_valid;
        $category->create_at = time();
        $category->update_at = time();
        $category->save(false);
        echo json_encode(['errorMsg'=>false]);
    }
    
    public function actionGetInfo(){
        $id = \Yii::$app->request->post('id');
        $result = Category::find()->asArray()->where(['id'=>$id])->one();
        echo json_encode(['row'=>$result]);
    }
    
    public function actionGetSelectCategory(){
        $id = $this->_request->post('id');
        $tree = new Tree ();
        
        $sql = "select * from {{%tbl_category}} order by sort_by asc,id desc";
        $cmd = \Yii::$app->db->createCommand($sql);
        $result = $cmd->queryAll();
        $array = array();
        foreach ($result as $r) {
            $r ['cname'] = $r ['name'];
            $r ['selected'] = $r ['id'] == $id ? 'selected' : '';
            $array [] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$cname</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0, $str);
        echo $select_categorys;
    }
    
    public function actionDelete(){
        $id = $this->_request->post('id');
        
        $cnt = Category::find()->where(['parentid'=>$id])->count();
        if ($cnt>0){
            echo json_encode(['status'=>0,'message'=>'请先删除子栏目!']);
            exit();
        }        
        $category = Category::findOne($id);
        $category->delete();
        echo json_encode(['status'=>1]);
    }
    
    public function __destruct(){
        unset($this->_request);
    }
    
}