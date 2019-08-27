<?php

namespace app\modules\controllers;
use app\models\RemindWord;
use Yii;

class InputController extends BaseController
{

    public function actionIndex(){
        $request = Yii::$app->request;

        $id = $request->post('id');
        $tag = $request->post('tag');
        $content = $request->post('content');
        $connect = $request->post('connect');
        $model = null;
        if(!empty($id)){
            $model = RemindWord::find()->where(['id'=>$id])->one();
        }
        if(empty($model)){
            $model = new RemindWord();
        }
        $model->tag = $tag;
        $model->content = $content;
        $model->connect = $connect;

        $res = $model->save();

        if($res){
            return $this->asJson(['status'=>200,'info'=>'success']);
        }

        return $this->asJson(['status'=>0,'info'=>'failure']);
    }
}