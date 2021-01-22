<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Contact;

class SiteControlller extends Controller
{
    public function home()
    {
        $params = ['name' => 'Luu Xuan Dat'];
        return $this->render('home', $params);
    }

    public function about()
    {
        return $this->render('about');
    }

    public function contact()
    {
        $contact = new Contact();
        return $this->render('contact', ['model' => $contact]);
    }

    public function handleContact(Request $request)
    {
        $contact = new Contact();
        $contact->loadData($request->getBody());

        if($contact->validate() && $contact->send()){
            Application::$app->session->setFlash('success', 'Thanhk for contact');
            Application::$app->response->redirect('/');
            exit;
        }

        return $this->render('contact', ['model' => $contact]);
    }
}
