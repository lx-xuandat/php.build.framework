<?php


namespace app\core\forms;


use app\core\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form method="%s" action="%s">', $method, $action);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}
