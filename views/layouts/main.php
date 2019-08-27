<?php
use yii\helpers\Html;
use app\assets\BaseAsset;
BaseAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html lang="zh-CN">
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title>标题</title>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <script>
            function addLoadEvent(b) {
                var a = window.onload;
                if (typeof window.onload != "function") {
                    window.onload = b;
                } else {
                    window.onload = function () {
                        a();
                        b();
                    }
                }
            }
        </script>
        <?php $this->head() ?>

        <?php if (isset($this->blocks['css'])) echo $this->blocks['css']; ?>
        <script>
            var csrf = '<?= Yii::$app->request->csrfToken ?>';
        </script>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div id="wrapper" class="home ">
        <?= $this->render('head') ?>
        <?= $content ?>
        <?= $this->render('foot') ?>
    </div>
    <!--参数传递js脚本模块-->
    <?php if (isset($this->blocks['js'])) echo $this->blocks['js']; ?>
    <?php $this->endBody() ?>
    <!--结束js脚本模块-->
    <?php if (isset($this->blocks['jsEnd'])) echo $this->blocks['jsEnd']; ?>

    </body>

    </html>
<?php $this->endPage() ?>