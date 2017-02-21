<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property string $id
 * @property integer $parentid
 * @property string $name
 * @property integer $sort_by
 * @property integer $is_valid
 * @property integer $create_at
 * @property integer $update_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'sort_by', 'is_valid', 'create_at', 'update_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'sort_by' => 'Sort By',
            'is_valid' => 'Is Valid',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
