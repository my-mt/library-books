<?php

namespace app\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{

    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;
    private $_user = false; // в эту переменную будет помещаться объект пользователя из таблицы user, имя которого будет совпадать в форме входа. Далее поля объекта $_user будут сравниваться в заполнеными полями формы ввода

    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'on' => 'default'],
            [['email', 'password'], 'required', 'on' => 'loginWithEmail'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)): // если объект пользователя не получен или введенный пароль не совпадает
                $field = ($this->scenario === 'loginWithEmail') ? 'email' : 'username';
                $this->addError($attribute, 'Неправильный ' . $field . ' или пароль.');
            endif;
        endif;
    }

    public function getUser()
    {
        if ($this->_user === false):
            if ($this->scenario === 'loginWithEmail'):
                $this->_user = User::findByEmail($this->email);
            else:
                $this->_user = User::findByUsername($this->username); // метод из модели User
            endif;
        endif;
        return $this->_user; // вернуть объект найденного пользователя
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Емайл',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function login()
    {
        if ($this->validate()):
            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

}
