<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/10/28
 * Time: 14:57
 */

namespace app\modules\admin\controllers;


use app\modules\admin\components\BaseController;
use app\components\Tree;
use app\components\Util;
use app\models;

class MenuController extends BaseController
{

    public function actionList()
    {
        $this->initFocus('sys', 'sys_menu');
        parent::init();

        $tree = new Tree ();
        $tree->icon = array(
            '&nbsp;&nbsp;&nbsp;│ ',
            '&nbsp;&nbsp;&nbsp;├─ ',
            '&nbsp;&nbsp;&nbsp;└─ '
        );
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $sql = "select * from {{%tbl_menu}} order by listorder asc,id desc";
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
            $r ['str_manage'] = "<a class=\"btn btn-success btn-xs\"  href='/admin/menu/add/parentid/" . $r ['id'] . "'>添加子菜单</a>";
            $r ['str_manage'] .= "  <a class=\"btn btn-info btn-xs\"  href='/admin/menu/edit/id/" . $r['id'] . "/parentid/" . $r ['parentid'] . "'>修改</a>";
            $r ['str_manage'] .= "  <a class=\"btn btn-danger btn-xs\" href='#' onclick='checkDel(" . $r ['id'] . ")'>删除</a>";
            $array [] = $r;
        }

        $str = "<tr>
					<td align='center'><label class='position-relative'><input name='listorders[\$id]' value='\$listorder' type='checkbox' class='ace'><span class='lbl'></span></label></td>
					<td align='center'>\$id</td>
					<td >\$spacer\$cname</td>
					<td align='center'>\$listorder</td>
					<td align='center'>\$icon</td>
					<td align='center'>\$action</td>
					<td align='center'>\$method</td>
					<td align='left'>\$str_manage</td>
				</tr>";
        $tree->init($array);
        $categorys = $tree->get_tree(0, $str);

        return $this->render('list', [
            'categorys' => $categorys
        ]);
    }

    public function actionAdd()
    {
        $this->initFocus('sys', 'sys_menu');
        parent::init();
        $tree = new Tree ();
        $parentid = intval(\Yii::$app->request->get('parentid'));

        $sql = "select * from {{%tbl_menu}} order by listorder asc,id desc";
        $cmd = \Yii::$app->db->createCommand($sql);
        $result = $cmd->queryAll();
        $array = array();
        foreach ($result as $r) {
            $r ['cname'] = $r ['name'];
            $r ['selected'] = $r ['id'] == $parentid ? 'selected' : '';
            $array [] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$cname</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0, $str);
        return $this->render('add', [
            'select_categorys' => $select_categorys
        ]);
    }

    public function actionDoadd()
    {
        $menu = new models\TblMenu();

        $menu->create_time = $menu->modify_time = date("Y-m-d H:i:s");
        //$menu->load(\Yii::$app->request->post());
        $menu->setAttributes(\Yii::$app->request->post());

        $status = 0;
        $msg = "";

        if ($menu->validate() && $menu->save(false)) {
            $status = 1;
            $msg = "操作成功！";
        } else {
            $status = 0;
            $msg = $menu->getErrors();
        }

        echo json_encode([
            'status' => $status,
            'msg' => $msg
        ]);
    }

}