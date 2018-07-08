<?php

namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $status;
    public $captcha;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password', 'captcha'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['captcha', 'captcha'],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' => [
                    User::STATUS_NOT_ACTIVE,
                    User::STATUS_ACTIVE
                ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Эл. почта',
            'password' => 'Пароль'
        ];
    }

    public function reg()
    {
        $user = new User(); // создаем новый объект $user модели User и заполняем его
        $user->username = $this->username; // атрибут username объекта $user, равен введенному имени пользователя
        $user->email = $this->email;
        $user->status = $this->status; // атрибут status пока по умолчанию равен 10 (активированный пользователь)
        $user->setPassword($this->password); // вызываем хелпер setPassword() из модели User, который сформирует из введенного пароля хеш
        $user->generateAuthKey(); // вызываем хелпер из модели User
        //  if($this->scenario === 'emailActivation')
        // $user->generateSecretKey();

        return $user->save() ? $user : null; //сохраняем нового пользователя в базе данных и если пользователь сохранился, возвращаем его объект, если нет возвращаем null
    }

    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом).'])
                        ->setTo($this->email)
                        ->setSubject('Активация для ' . Yii::$app->name)
                        ->send();
    }

}
