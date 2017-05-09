<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{

    public $title;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'seo' => [
                'class' => \notgosu\yii2\modules\metaTag\components\MetaTagBehavior::className(),
                'languages' => ['ru'],
            ]
        ];
    }

}
