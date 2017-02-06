<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_roleright}}".
 *
 * @property integer $role_id
 * @property string $right_ids
 */
class TblRoleright extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_roleright}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id'], 'required'],
            [['role_id'], 'integer'],
            [['right_ids'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'right_ids' => 'Right Ids',
        ];
    }
}
