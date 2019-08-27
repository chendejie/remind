<?php

namespace app\controllers;

use app\models\Redis;
use app\service\ErrorService;

class ErrorController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
       return $this->render('index');
    }
}