<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;

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
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $data = $request->getBody();
        var_dump($data);
        return 'handling submitted data';
    }
}
