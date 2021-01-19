<?php


namespace app\models;


use app\core\Model;

class RegisterModel extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmPassword;

    public function register()
    {
        return true;
    }

    /**
     *return array ( $attribute => $rule)
     * $rule is string or array
     */
    public function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 8],
                [self::RULE_MAX, 50],
            ],
            'confirmPassword' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'password'],
            ],
        ];
    }
}
