<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tool]].
 *
 * @see Tool
 */
class ToolQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Tool[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tool|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}