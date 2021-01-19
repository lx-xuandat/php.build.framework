<?php


namespace app\core;


abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public array $erors = [];

    /**
     * mapping form data with instance
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $propertyOfInstance => $arrayRules) {
            $valueOfInstance = $this->{$propertyOfInstance};

//            echo $propertyOfInstance . ' - ' . $valueOfInstance . '<br>';
//            print_r($rules);

            foreach ($arrayRules as $rules) {
                if (is_string($rules)) {
                    $rule = $rules;
                }

                if (is_array($rules)) {
                    $rule = $rules[0];
                }

                if ($rule === self::RULE_REQUIRED && !$valueOfInstance) {
                    $this->addError($propertyOfInstance, self::RULE_REQUIRED);
                }

                if ($rule === self::RULE_EMAIL && !filter_var($valueOfInstance, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($propertyOfInstance, self::RULE_EMAIL);
                }

                if ($rule === self::RULE_MIN && (strlen($valueOfInstance) < $rules[1])) {
                    $this->addError($propertyOfInstance, self::RULE_MIN, ['min' => $rules[1]]);
                }

                if ($rule === self::RULE_MAX && (strlen($valueOfInstance) > $rules[1])) {
                    $this->addError($propertyOfInstance, self::RULE_MAX, ['max' => $rules[1]]);
                }

                if ($rule === self::RULE_MATCH && $valueOfInstance != $this->{$rules[1]}) {
                    $this->addError($propertyOfInstance, self::RULE_MATCH, ['match' => $rules[1]]);
                }
            }
        }

        return empty($this->erors);
    }

    abstract public function rules();

    public function addError(string $attribute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->erors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
        ];
    }

    public function hasError($attibute)
    {
        return $this->erors[$attibute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->erors[$attribute][0] ?? false;
    }
}
