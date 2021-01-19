<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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
        $model = new RegisterModel();

        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->register()) {
                return 'success';
            }
        }

        return $this->render('register', ['model' => $model]);
    }
}
