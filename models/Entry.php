<?php

namespace app\models;
use \app\models\base\Entry as BaseEntry;

/**
 * This is the model class for table "entry".
 */
class Entry extends BaseEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['form', 'subject_id', 'ref_id','entry'], 'integer'],
            [['subject', 'ref'], 'string'],
            [['score'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ]);
    }

}
