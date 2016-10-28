<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/10/28
 * Time: 12:46
 */

namespace app\components;


use yii\base\Widget;

class NavMenuWidget extends Widget {
    public $rightarr;
    public function init()
    {
        parent::init();
    }

    public function run(){
        return $this->render('navMenu',['rightarr'=>$this->rightarr]);
    }

}