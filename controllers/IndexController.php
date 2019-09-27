<?php

namespace app\controllers;

use app\models\RemindWord;
use app\models\RemindWordNew;
use yii\db\Query;
use yii\web\Controller;
use Yii;

class IndexController extends BaseController
{


    public function actionIndex()
    {
        $id = Yii::$app->request->get('id',1);
        empty($id) && $id = 1;
        $size = Yii::$app->request->get('size',256);
        $r = RemindWord::find()->where(['>=','id',$id])->limit($size)->all();
        $data = [];
        $tid = Yii::$app->request->get('tid',0);//这个
        if(!empty($r)){
            $arr = $this->getNum(256);
            !isset($arr[$tid]) && $tid = 0;
            if(isset($r[$arr[$tid]-1])){
                $data = $r[$arr[$tid]-1];
            }
        }


        return $this->render('index',['data'=>$data,'tid'=>$tid,'id'=>$id]);
    }

    public function actionIndex2()
    {
        $id = Yii::$app->request->get('id',1);
        $gsize = Yii::$app->request->get('gsize',5);
        
        empty($id) && $id = 1;
        $size = Yii::$app->request->get('size',256);
        $r = RemindWordNew::find()->where(['>=','id',$id])->limit($size)->asArray()->all();
        $data = [];
        $tid = Yii::$app->request->get('tid',0);//这个
        if(!empty($r)){
            $arr = $this->getNum(256);
            !isset($arr[$tid]) && $tid = 0;
            if(isset($r[$arr[$tid]-1])){
                $data = array_slice($r, ($arr[$tid]-1)*$gsize,$gsize);
            }
        }
        // echo '<pre>';
        // print_r($data);die;

        return $this->render('index2',['data'=>$data,'tid'=>$tid,'id'=>$id]);
    }

    public function getNum($num){
//        $t = 1;
//        var_dump(range((2^$t)-2,0,-1));die;
        $n = 1;
        $arr = [];
        while(true){
            if($n>$num){
                break;
            }
            if($n%2==1){
                $arr[] = $n;
            }
            if($n%2==0){
                $arr[] = $n;
                $t = 1;
                foreach (range(pow(2,$t)-1,0,-1) as $item) {
                    $arr[] = $n-$item;
                }
                $m = $n;
                while(true){
                    $n = $n/2;//1
                    $t += 1;
                    if($n%2==0){
                        foreach (range(pow(2,$t)-1,0,-1) as $item) {
                            $arr[] = $m-$item;
                        }
                    }else{
                        break;
                    }
                }
                $n = $m;
            }
            $n+=1;
        }

        return $arr;
    }

}
/*


0001
0010
0001,0010-->-1,-0==>2^1-1

0011
0100
0011,0100-->-1,-0
0001,0010,0011,0100-->-3,2,1,0==>2^2-1

0101
0110
0101,0110-->-1,-0==>2^1-1
0111
1000
0111,1000-->-1,-0===>2^1-1
0101,0110,0111,1000->-3-2-1-0===>2^2-1
0001,0010,0011,0100,0101,0110,0111,1000-->7-6-5-4-3-2-1-0==>2^3-1


----
1001
1010
1001,1010-->-1,-0

1011
1100
1011,1100-->-1,-0
1001,1010,1011,1100->3,2,1,0

1101
1110
1101,1110-->-1,-0
1111
10000
1111,1000->-1,-0
1101,1110,1111,10000->3,2,1,0
1001,1010,,1110,1111,10000->7,6,5,4,3,2,1,0
0001,,,1111,10000->15,14,13,,,,1,0









2*2^0-1
2*2^0
2*2^0-1, 2*2^0---->0

2*2^1-1
2*2^1
2*2^1-1, 2*2^1---->1
2*2^0-1, 2*2^0,2*2^1-1, 2*2^1


2*2*2-1
2*2*2
2*2*2-1, 2*2*2----*2

2*2^1-1
2*2^1
2*2^1-1, 2*2^1---->1
2*2^0-1, 2*2^0,2*2^1-1, 2*2^1




2*1-1
2*1
复习 2*1-1,2*1
2*2-1
2*2--->2*2-1,2*2,2*(2-1)-1,2*(2-1)
复习 2*2-1,2*2
二轮: 2*(2-1)-1,2*(2-1),2*2-1,2*2

2*3-1
2*3
复习2*3-1,2*3
2*4-1
2*4
复习2*4-1,2*4
二轮:2*3-1,2*3,2*4-1,2*4
三轮:2*(2-1)-1,2*(2-1),2*2-1,2*2,2*3-1,2*3,2*4-1,2*4


1-
2-
3
4
5
6
7
8
9
10
11
12
13
14
15
16

1,2,1,2,3,4,3,4,1,2,3,4
5,6,5,6,7,8,7,8,5,6,7,8
1,2,3,4,5,6,7,8
9,10,9,10,11,12,11,12,9,10,11,12
13,14,13,14,15,16,15,16,13,14,15,16
9,10,11,12,13,14,15,16
1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16

 */