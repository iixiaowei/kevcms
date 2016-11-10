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
}
