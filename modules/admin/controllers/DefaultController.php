<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\BaseController;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
//        echo \Yii::getAlias('@vendor');
        $this->initFocus('index','index');
        parent::init();
        return $this->render('index');
    }

    public function actionError()
    {
        $active = \Yii::$app->request->get("active");
        $focus = \Yii::$app->request->get("focus");

        $this->initFocus($active,$focus);
        parent::init();
        $message =  \Yii::$app->request->get("message");
        $jumpUrl =  \Yii::$app->request->get("jumpUrl");
        return $this->render("error",array('message'=>$message,
            'waitSecond'=>3,'jumpUrl'=>urldecode($jumpUrl)));
    }

    public function actionSuccess()
    {
        $active = \Yii::$app->request->get("active");
        $focus = \Yii::$app->request->get("focus");

        $this->initFocus($active,$focus);
        parent::init();
        $message = \Yii::$app->request->get("message");
        $jumpUrl = \Yii::$app->request->get("jumpUrl");
        return $this->render("success",array('message'=>$message,
            'waitSecond'=>3,'jumpUrl'=>urldecode($jumpUrl)));
    }

}
