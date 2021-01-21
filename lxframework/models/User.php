<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmPassword;
    public $status = self::STATUS_INACTIVE;

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->status = self::STATUS_INACTIVE;
        return $this->save();
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
                [
                    self::RULE_UNIQUE,
                    'class'=>self::class,
                ],
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

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password','status'];
    }
}
