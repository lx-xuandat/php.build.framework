<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $login = new LoginForm();
        if ($request->isPost()) {
            $login->loadData($request->getBody());

            if ($login->validate() && $login->login()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('auth/login', ['model' => $login]);
    }

    public function register(Request $request)
    {
        $model = new User();

        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                Application::$app->session->setFlash('success', 'Thanhk for register');
                Application::$app->response->redirect('/');
                exit;
            }
        }

        return $this->render('auth/register', ['model' => $model]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile(){
        return $this->render('profile');
    }
}
