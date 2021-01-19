<?php


namespace app\core;


class Response
{

    public function setStattusCode(int $code)
    {
        http_response_code($code);
    }
}
