<?php

namespace app\models;

use \app\models\base\Form as BaseForm;

/**
 * This is the model class for table "form".
 */
class Form extends BaseForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['tool', 'field', 'ordering', 'created_by', 'updated_by'], 'integer'],
            [['weight'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
