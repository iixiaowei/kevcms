<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_role}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $is_valid
 * @property string $description
 * @property integer $sort_by
 * @property integer $rtime
 * @property integer $mtime
 */
class TblRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_valid', 'sort_by', 'rtime', 'mtime'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 200],
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
            'is_valid' => 'Is Valid',
            'description' => 'Description',
            'sort_by' => 'Sort By',
            'rtime' => 'Rtime',
            'mtime' => 'Mtime',
        ];
    }
}
