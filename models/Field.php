<?php

namespace app\models;

use \app\models\base\Field as BaseField;

/**
 * This is the model class for table "field".
 */
class Field extends BaseField
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['category', 'created_by', 'updated_by'], 'integer'],
            [['description', 'datatype'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
