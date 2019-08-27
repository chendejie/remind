<?php

namespace app\assets\input;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';

    public $css = [
        'css/input/index.css',
    ];
    public $js = [
        'js/input/index.js',
    ];
    public $depends = [
        'app\assets\BaseAsset'
    ];
}
