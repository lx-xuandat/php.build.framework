<?php


namespace app\core;

use app\core\exceptions\NotFoundException;

class Router
{

    protected $routes = [];

    public Request $request;
    public Response $response;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStattusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var Controller $controller */
            $controller = new $callback[0]();
            $controller->action = $callback[1];
            Application::$app->controleler = $controller;
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        $content = $this->renderContent($view, $params);
        $layout = $this->renderLayout();

        return str_replace('{{@content}}', $content, $layout);
    }

    public function renderLayout()
    {
        if (Application::$app->controleler) {
            $layout = Application::$app->controleler->getLayout();
        } else {
            $layout = 'main';
        }
        ob_start();
        include __LAYOUTS__ . $layout . '.php';
        return ob_get_clean();
    }

    public function renderContent($view, $params = [])
    {
        foreach ($params as $key => $value):
            $this->{$key} = $value;
        endforeach;
        ob_start();
        include __VIEWS__ . $view . '.php';
        return ob_get_clean();
    }

}
