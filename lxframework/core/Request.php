<?php


namespace app\core;


class Request
{

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = str_replace('/php.build.framework/lxframework/public', '', $path);
        $questionMark = strpos($path, '?');

        if ($questionMark === false) {
            return $path;
        }

        return substr($path, 0, $questionMark);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {
        $body = [];

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                unset($_POST[$key]);
            }
        }

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                unset($_GET[$key]);
            }
        }

        return $body;
    }
}
