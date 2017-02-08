<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_recommend}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $category_id
 * @property integer $sort_by
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $is_valid
 */
class Recommend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_recommend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'sort_by', 'create_at', 'update_at','is_valid'], 'integer'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'sort_by' => 'Sort By',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'is_valid' => 'is_valid'
        ];
    }
}
