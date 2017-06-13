<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property integer $id
 * @property string $name
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
     * @return EquipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EquipmentQuery(get_called_class());
    }
}
