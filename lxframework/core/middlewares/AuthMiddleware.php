<?php


namespace app\core\middlewares;


use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends Middleware
{

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions=[])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (in_array(Application::$app->controleler->action, $this->actions) || empty($this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
