<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $surname;
    public $patronymic;
    public $login;
    public $password;
    public $password_repeat;
    public $rules;

    public function attributeLabels(){
        return ['name'=>'Имя',
        'surname'=>'Фамилия',
        'patronymic' => 'Отчество',
        'login' => 'Логин',
        'email' => 'Почта',
        'password' => 'Пароль',
        'password_repeat' => 'Повторите пароль',
        'rules' => 'Соглашение с правилами'];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'surname', 'login', 'password','password_repeat','rules'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            [['email','login'], 'unique','targetClass' => User::class],
            ['password','string','min'=>6],
            ['password_repeat','compare','compareAttribute' => 'password'],
            ['rules','boolean'],
            ['rules','compare','compareValue' => 1],


            ['patronymic','string'],

        ];
    }

   
    public function registerUser(){
        if($this -> validate()){
            $user = new User();
            if($user->load($this->attributes,'')){
                if ($user ->save()){
                    return $user;
                }
            }
        }
        return false;
    }
}