<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_operator}}".
 *
 * @property string $id
 * @property string $name
 * @property string $password
 * @property integer $role_id
 * @property integer $last_logintime
 * @property string $last_loginip
 * @property string $login_token
 * @property integer $is_valid
 * @property integer $rtime
 * @property integer $mtime
 */
class Operator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_operator}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            [['role_id', 'last_logintime', 'is_valid', 'rtime', 'mtime'], 'integer'],
            [['name', 'last_loginip'], 'string', 'max' => 20],
            [['password', 'login_token'], 'string', 'max' => 32],
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
            'password' => 'Password',
            'role_id' => 'Role ID',
            'last_logintime' => 'Last Logintime',
            'last_loginip' => 'Last Loginip',
            'login_token' => 'Login Token',
            'is_valid' => 'Is Valid',
            'rtime' => 'Rtime',
            'mtime' => 'Mtime',
        ];
    }
}
