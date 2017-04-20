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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.less',
        'css/flexslider.less',
//        'css/forms.less',
        'css/reset.less',
        'css/skeleton.less',
        'css/style.less',
        'css/superfish.less',
        'css/ui.totop.less',
    ];

    public $js = [
        'js/jquery-1.7.2.min.js',
        'js/forms.js',
        'js/jquery.easing.1.3.js',
        'js/jquery.equalheights-rt.js',
        'js/jquery.flexslider-min.js',
        'js/jquery.responsivemenu.js',
        'js/jquery.ui.totop.js',
        'js/script.js',
        'js/superfish.js'
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = array( 'position' => \yii\web\View::POS_HEAD );
}
