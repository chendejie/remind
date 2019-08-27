<?php

namespace app\models;

use yii\db\ActiveRecord;

class RemindWord extends ActiveRecord{
    public static function tableName()
    {
        return 'remind_word';
    }
}