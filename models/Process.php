<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "process".
 *
 * @property integer $id
 * @property string $name
 */
class Process extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return ProcessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProcessQuery(get_called_class());
    }
}
