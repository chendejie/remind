<?php
return [
    'enablePrettyUrl' => true,  //美化url==ture
    'enableStrictParsing' => false,  //不启用严格解析
    'showScriptName' => false,   //隐藏index.php
    'rules' => [
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ]
];
