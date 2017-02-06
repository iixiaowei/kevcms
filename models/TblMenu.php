<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_menu}}".
 *
 * @property string $id
 * @property integer $parentid
 * @property string $name
 * @property string $icon
 * @property string $action
 * @property string $method
 * @property string $create_time
 * @property string $modify_time
 * @property integer $listorder
 * @property string $alias_name
 * @property string $focus
 * @property string $active
 */
class TblMenu extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'listorder'], 'integer','message'=>'必须为数字'],
            [['create_time', 'modify_time'], 'safe'],
            [['name', 'action', 'method'], 'string', 'max' => 30],
            [['icon'], 'string', 'max' => 255],
            [['alias_name', 'focus'], 'string', 'max' => 50],
            [['active'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentid' => 'Parentid',
            'name' => 'Name',
            'icon' => 'Icon',
            'action' => 'Action',
            'method' => 'Method',
            'create_time' => 'Create Time',
            'modify_time' => 'Modify Time',
            'listorder' => 'Listorder',
            'alias_name' => 'Alias Name',
            'focus' => 'Focus',
            'active' => 'Active',
        ];
    }

    /**
     * @inheritdoc
     * @return TblMenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TblMenuQuery(get_called_class());
    }
    
    public function getMenuTree($id,$rightids){
        $menus = $this->find()
                      ->where(['parentid'=>$id])->orderBy("listorder desc")->asArray()->all();
        $json_data = array();
        foreach ($menus as $rs):
            $id = $rs['id'];
            $cnt = $this->find()
                        ->where(['parentid'=>$id])->count();
            if ($cnt>0){
                $json_data[]=array(
                    'id'=>$rs['id'],
                    'text'=>$rs['name'],
                    'children'=>$this->getChildTrees($id,$rightids),
                    'cascadeCheck'=>true,
                    "checked"=>in_array($id, $rightids)?true:false
                );
            }else{
                $json_data[]=array(
                    'id'=>$rs['id'],
                    'text'=>$rs['name'],
                    'cascadeCheck'=>true,
                    "checked"=>in_array($id, $rightids)?true:false
                );
            }
            
        endforeach;
        return $json_data;
    }
    
    public function getChildTrees($pid,$rightids){
        $data = array();
        $menus = $this->find()
                      ->where(['parentid'=>$pid])->orderBy("listorder desc")->asArray()->all();
        foreach ($menus as $rs):
            $id = $rs['id'];
            $cnt = $this->find()
                        ->where(['parentid'=>$id])->count();
            if ($cnt>0){
                $data[]=array(
                    'id'=>$rs['id'],
                    'text'=>$rs['name'],
                    'children'=>$this->getChildTrees($id,$rightids),
                    'cascadeCheck'=>true,
                    "checked"=>in_array($id, $rightids)?true:false
                );
            }else{
                $data[]=array(
                    'id'=>$rs['id'],
                    'text'=>$rs['name'],
                    'cascadeCheck'=>true,
                    "checked"=>in_array($id, $rightids)?true:false
                );
            }
        endforeach;
        return $data;
    }
    
}
