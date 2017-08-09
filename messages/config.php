<?php

return [
    'sourcePath' => '@app',
    'languages' => ['uk', 'en', 'ru'],
    'translator' => '\Yii::t',
    'sort' => true,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
        '/vendor',
    ],
    'format' => 'php',
    'messagePath' => '@app/messages',
    'overwrite' => true,
];
