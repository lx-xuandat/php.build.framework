<?php


namespace app\core;


class Application
{
    public static $app;

    public Router $router;
    public Request $request;
    public Response $response;

    public ?Controller $controleler;

    public Database $db;

    public Session $session;
    /**
     * Application constructor.
     */
    public function __construct(array $config)
    {
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $this->session = new Session();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
