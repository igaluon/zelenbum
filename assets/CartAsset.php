<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/style.less',
        'css/mystyle.less',
        'css/superfish.less',

    ];

    public $js = [
        'js/jquery-1.7.2.min.js',
        'js/superfish.js'

    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
