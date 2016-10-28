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

class MenuController extends BaseController {

    public function actionList()
    {
        $this->initFocus('sys','sys_menu');
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

        return $this->render('list',[
            'categorys' => $categorys
        ]);
    }

}