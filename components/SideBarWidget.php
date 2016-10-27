<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/10/26
 * Time: 14:14
 */
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
class SideBarWidget extends Widget {
    public $rightids;
    public $rightarr;

    public function init(){
        parent::init();

    }

    public function run(){

        return $this->render('sideBar',['rightids'=>$this->rightids,'rightarr'=>$this->rightarr]);
    }


}