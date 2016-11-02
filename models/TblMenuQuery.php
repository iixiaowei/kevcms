<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TblMenu]].
 *
 * @see TblMenu
 */
class TblMenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TblMenu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TblMenu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
