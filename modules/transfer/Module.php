<?php

namespace app\modules\transfer;

/**
 * transfer module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\transfer\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout='main';
        parent::init();


        // custom initialization code goes here
    }
}
