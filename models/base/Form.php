<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "form".
 *
 * @property integer $id
 * @property integer $tool
 * @property integer $field
 * @property double $weight
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Entry[] $entries
 * @property \app\models\Tool $tool0
 * @property \app\models\Field $field0
 */
class Form extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tool', 'field', 'ordering', 'created_by', 'updated_by'], 'integer'],
            [['weight'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tool' => Yii::t('app', 'Tool'),
            'field' => Yii::t('app', 'Field'),
            'weight' => Yii::t('app', 'Weight'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntries()
    {
        return $this->hasMany(\app\models\Entry::className(), ['form' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTool0()
    {
        return $this->hasOne(\app\models\Tool::className(), ['id' => 'tool']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField0()
    {
        return $this->hasOne(\app\models\Field::className(), ['id' => 'field']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\FormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\FormQuery(get_called_class());
    }
}
