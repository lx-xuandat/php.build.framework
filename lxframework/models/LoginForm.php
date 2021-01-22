<?php


namespace app\models;


use app\core\Application;
use app\core\DbModel;
use app\core\Model;

class LoginForm extends DbModel
{

    public $email;
    public $password;

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'email',
            'password',
        ];
    }

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Your Password',
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }

    public function primaryKey(): string
    {
        return 'id';
    }
}
