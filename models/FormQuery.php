<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Form]].
 *
 * @see Form
 */
class FormQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Form[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Form|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}