<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'body'], 'required', 'message' => \Yii::t('app', '*Поле обязательное к заполнению.')],
            // email has to be a valid email address
            ['email', 'email', 'message' => \Yii::t('app', '*Введите корректрый емейл.')],
//            ['name', 'lang' => 'ru', 'message' => 'Неправильное имя'],
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->phone)
            ->setTextBody($this->body)
            ->send();
    }
}
