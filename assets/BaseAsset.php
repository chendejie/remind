<?php

namespace app\assets;

use yii\web\AssetBundle;

class BaseAsset extends AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';

    public $css = [
        'bootstrap-3.3.7-dist/css/bootstrap.css',
        'bootstrap-3.3.7-dist/css/bootstrap-theme.css',
        'css/base/base.css',
    ];
    public $js = [
        'js/jquery.js',
        'bootstrap-3.3.7-dist/js/bootstrap.js',
        'js/base/base.js',
    ];
}
