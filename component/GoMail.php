<?php
namespace app\component;

use yii\base\Component;


class GoMail extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject,$text,$emailFrom='igaluon@gmail.com',$nameFrom='Advert')
    {
        if(\Yii::$app->mailer->compose()
            ->setFrom(['yii2.school@yandex.ru' => 'Advert'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()){
            $this->trigger(self::EVENT_NOTIFY);
            return true;
        }
    }

    public function notifyAdmin($event){

        print "Notify Admin";
    }

}