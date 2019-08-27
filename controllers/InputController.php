<?php

namespace app\controllers;

use app\models\RemindWord;
use Yii;

class InputController extends \app\controllers\BaseController
{

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $data = null;
        if(!empty($id)){
            $data = RemindWord::find()->where(['id'=>$id])->one();
        }

        return $this->render('index',['data'=>$data]);
    }
}