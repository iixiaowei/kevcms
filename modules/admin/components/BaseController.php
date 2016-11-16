<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/10/26
 * Time: 14:40
 */
namespace app\modules\admin\components;

use yii\web\Controller;

class BaseController extends Controller {
    private $_adminid;
    private $_roleid;
    private $_rightids;
    public $_rightarr;
    public $_menu;
    public $_active;

    public function init()
    {
        parent::init();
        $session = \Yii::$app->session;
        if (empty( $session['adminid'])) {
            return $this->redirect('/admin/public/login');
            exit;
        }

        $this->_adminid = $session['adminid'];
        $this->_roleid  = $this->getRoleId();
        $this->_rightids = $this->getRightIds();
        $this->_rightarr = $this->getRightIdsArr($this->_rightids);

        $view = \Yii::$app->view;
        $view->params['adminid']   = $this->_adminid;
        $view->params['adminname'] = $session['adminname'];
        $view->params['rightids']    = $this->_rightids;
        $view->params['rightarr']    = $this->_rightarr;
        $view->params['menu']    = $this->_menu;
        $view->params['active']    = $this->_active;
    }

    public function initFocus($menu,$active){
        $this->_menu = $menu;
        $this->_active = $active;
    }

    protected function getRoleId(){
        $sql = "SELECT role_id FROM {{%tbl_operator}} WHERE id=:id";
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(":id", $this->_adminid);
        return $cmd->queryScalar();
    }

    protected function getRightIds(){
        $role_id = $this->getRoleId();
        $ids ="" ;
        if($role_id==1){
            $sql = "SELECT id FROM {{%tbl_menu}} order by listorder desc ";
            $res = \Yii::$app->db->createCommand($sql)->queryAll();
            foreach ($res as $rs){
                $ids.=$rs['id'].",";
            }
        }else{
            $sql = "SELECT right_ids FROM {{%tbl_roleright}} WHERE role_id=:role_id";
            $cmd = \Yii::$app->db->createCommand($sql);
            $cmd->bindParam(":role_id", $role_id);
            $ids = $cmd->queryScalar();
        }
        return trim($ids,",");
    }

    protected function getRightIdsArr($ids){
        $arr=array();
        $arr = explode(",", $ids);
        $arr = array_unique($arr);
        return $arr;
    }

    protected function getParentId($rightids){
        $rightids = $this->getRightIds();
        $sql = "SELECT DISTINCT(parentid) FROM tbl_menu WHERE id IN($rightids)  order by listorder desc";
        $res = \Yii::$app->db->createCommand($sql)->queryAll();
        $pids = "";
        foreach ($res as $rs){
            $pids.=$rs['parentid'].",";
        }
        return trim($pids,",");
    }
}