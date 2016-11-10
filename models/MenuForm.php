<?php
/**
 * Created by PhpStorm.
 * User: 海伟
 * Date: 2016/11/9
 * Time: 11:47
 */

namespace app\models;


use yii\base\Model;

class MenuForm  extends Model{
    public $parentid;
    public $name;
    public $alias_name;
    public $action;
    public $method;
    public $icon;
    public $listorder;
    public $focus;
    public $active;

    public function rules()
    {
        return [
            [['name','alias_name','action','method','icon'],'required']
        ];
    }

}