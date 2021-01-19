<?php


namespace app\core;


class Application
{

    public static $config = [];
    public static $app;

    public Router $router;
    public Request $request;
    public Response $response;

    public ?Controller $controleler;

    /**
     * Application constructor.
     */
    public function __construct($config)
    {
        self::$config = $config;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
