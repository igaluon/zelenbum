<?php

return [
    'sourcePath' => '@app',
    'languages' => ['uk', 'en', 'ru'],
    'translator' => '\app\widgets\menu\Menus::t',
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
    'messagePath' => '@app/widgets/menu/messages',
    'overwrite' => true,
];
