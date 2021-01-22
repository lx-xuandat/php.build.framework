<?php


namespace app\models;


use app\core\DbModel;

class Contact extends DbModel
{

    public $subject, $email, $body;

    public function tableName(): string
    {
        return 'contact';
    }

    public function attributes(): array
    {
        return ['subject', 'email', 'body'];
    }

    public function rules()
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Your Subject',
            'email' => 'Your Email',
            'body' => 'Content',
        ];
    }

    public function send()
    {
        return parent::save();
    }
}
