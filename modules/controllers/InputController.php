<?php

namespace app\modules\controllers;
use app\models\RemindWord;
use app\models\RemindWordNew;
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

    public function actionIndexMul(){
        $request = Yii::$app->request;

        $data = $request->post('data');
        if(empty($data)){
            return $this->asJson(['status'=>0,'info'=>'failure']);
        }

        foreach ($data as $key => $value) {
            $model = null;
            $id = $value['id'];
            if(!empty($id)){
                $model = RemindWordNew::find()->where(['id'=>$id])->one();
            }
            if(empty($model)){
                $model = new RemindWordNew();
            }
            $model->tag = $value['tag'];
            $model->content = $value['content'];
            $model->connect = $value['connect'];
            $res = $model->save();
        }

        return $this->asJson(['status'=>200,'info'=>'success']);
    }
}