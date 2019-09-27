<?php

namespace app\models;

use yii\db\ActiveRecord;

class RemindWordNew extends ActiveRecord{
    public static function tableName()
    {
        return 'remind_word_new';
    }
}