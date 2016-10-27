<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/10/26
 * Time: 14:50
 */

namespace app\modules\admin\controllers;


use app\components\Util;
use app\models\Operator;
use yii\base\Controller;
use yii\web\UrlManager;

class PublicController extends Controller {
    public $layout = false;

    public function actionLogin(){

        return $this->render('login');
    }

    public function actionDologin(){
        $request  = \Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        if(empty($username) || empty($password)){
            echo json_encode(array('status'=>2,'message'=>'非法操作!'));
            exit;
        }

        $query =  Operator::find()->where(['name'=>$username]);
        $operator = $query->one();
        $logSql = $query->createCommand()->getRawSql();

        if(empty($operator)){
            echo json_encode(array('status'=>2,'message'=>'操作员不存在!'));
            exit;
        }else{
            if ($operator->password != md5($password)){
                echo json_encode(array('status'=>2,'message'=>'密码错误!'));
                exit;
            }

            if($operator->is_valid==0){
                echo json_encode(array('status'=>2,'message'=>'操作员被禁用!'));
                exit;
            }

            $login_token = md5(Util::toString());
            $operator->login_token = $login_token;
            $operator->save(false);
            $session = \Yii::$app->session;
            $session['adminid'] = $operator->id;
            $session['adminname'] = $operator->name;
            $session['last_logintime'] = date('Y-m-d H:i:s',$operator->last_logintime);
            $session['last_loginip']   = $operator->last_loginip;
            $session['login_token']    = $login_token;

            //log
            $actionName = \Yii::$app->controller->id;
            $methodName = \Yii::$app->controller->action->id;
            $moduleName = \Yii::$app->controller->module->id;
            Util::saveLog($moduleName, $actionName, $methodName, "管理员".$username."登录!".$logSql);
            echo json_encode(array('status'=>1,'message'=>'登录成功!'));
        }
    }

    public function actionLogout()
    {
        $session = \Yii::$app->session;
        unset($session['adminid']);
        unset($session['adminname']);
        unset($session['last_logintime']);
        unset($session['last_loginip']);
        unset($session['login_token']);
        return $this->run('/admin/public/login');
    }

}