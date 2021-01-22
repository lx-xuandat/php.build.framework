<?php


namespace app\core;


use app\core\middlewares\Middleware;

class Controller
{
    protected string $layout = 'main';
    public string $action = '';
    /**
     * @var \app\core\middlewares\Middleware[]
     */
    protected array $middlewares = [];

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function middleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
