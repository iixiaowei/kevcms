<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/11/16
 * Time: 8:26
 */

namespace app\modules\admin\controllers;


use app\components\Util;
use app\modules\admin\components\BaseController;

class LogController extends BaseController {

    public function actionList()
    {
        $this->initFocus('sys', 'sys_log');
        parent::init();
        return $this->render('list');
    }

    public function actionLog_list()
    {
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
            array( 'db' => 'module',  'dt' => 1 ),
            array( 'db' => 'controller',   'dt' => 2 ),
            array( 'db' => 'action',     'dt' => 3 ),
            array( 'db' => 'content',     'dt' => 4),
            array( 'db' => 'admin_id',     'dt' => 5),
            array( 'db' => 'rtime',     'dt' => 6),
            array( 'db' => 'ip',     'dt' => 7)
        );

        $sortCol = $columns[$iSortCol]['db'];
        $order = " ORDER BY $sortCol  $sSortDir";

        $sSearch_admin_id = Util::getOperatorIdByName($sSearch);
        $where=" where 1=1 ";
        if ($sSearch!=""){
            $where.=" AND ( ip like '%".$sSearch."%' or rtime like '%".$sSearch."%' or admin_id =  '%".$sSearch_admin_id."%' or content like '%".$sSearch."%' or action like '%".$sSearch."%' or id like '%".$sSearch."%' or module like '%".$sSearch."%' or  controller like '%".$sSearch."%'  )";
        }

        $sql = "select count(id) as nums from {{%tbl_logs}} $where ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $iTotalRecords = $cmd->queryScalar();

        $sEcho = $sEcho+1;
        $iTotalRecords = $iTotalRecords;
        $iTotalDisplayRecords = $iDisplayLength;


        $sql = "select id,module,controller,action,content,admin_id,FROM_UNIXTIME(rtime,'%Y-%m-%d %H:%i:%s') AS rtime,ip from {{%tbl_logs}} $where $order limit $iDisplayStart,$iTotalDisplayRecords  ";
        $cmd = \Yii::$app->db->createCommand($sql);
        $rs = $cmd->queryAll();

        $res = array();
        $i=0;
        foreach ($rs as $r){
            $res[$i]['id']=$r['id'];
            $res[$i]['module']=$r['module'];
            $res[$i]['controller']=$r['controller'];
            $res[$i]['action']=$r['action'];
            $res[$i]['content']=$r['content'];
            $res[$i]['admin_id'] = Util::getOperatorNameById($r['admin_id']);
            $res[$i]['rtime']=$r['rtime'];
            $res[$i]['ip']=$r['ip'];
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

}