<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Session;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return 'Handling login';
        }
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $model = new User();

        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                Application::$app->session->setFlash(Session::KEY_SUCCESS, 'Thanhk for register');
                Application::$app->response->redirect('/');
            }
        }

        return $this->render('auth/register', ['model' => $model]);
    }
}
