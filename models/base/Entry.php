<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "entry".
 *
 * @property integer $id
 * @property integer $form
 * @property string $subject
 * @property integer $subject_id
 * @property double $score
 * @property integer $ref
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Form $form0
 * @property \app\models\Reference $ref0
 */
class Entry extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form', 'subject_id', 'ref', 'created_by', 'updated_by'], 'integer'],
            [['subject'], 'string'],
            [['score'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entry';
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
            'form' => Yii::t('app', 'Form'),
            'subject' => Yii::t('app', 'Subject'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'score' => Yii::t('app', 'Score'),
            'ref' => Yii::t('app', 'Ref'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm0()
    {
        return $this->hasOne(\app\models\Form::className(), ['id' => 'form']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRef0()
    {
        return $this->hasOne(\app\models\Reference::className(), ['id' => 'ref']);
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
     * @return \app\models\EntryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\EntryQuery(get_called_class());
    }
}
