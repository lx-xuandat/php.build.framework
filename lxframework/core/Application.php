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

    public ?DbModel $user;

    public string $userClass;

    /**
     * Application constructor.
     */
    public function __construct(array $config)
    {
        $this->userClass = $config['userClass'];
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $this->session = new Session();

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
