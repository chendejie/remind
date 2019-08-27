<?php

namespace app\assets\index;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';

    public $css = [
        'css/index/index.css',
    ];
    public $js = [
        'js/index/index.js',
    ];
    public $depends = [
        'app\assets\BaseAsset'
    ];
}
