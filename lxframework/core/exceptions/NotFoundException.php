<?php


namespace app\core\exceptions;


class NotFoundException extends \Exception
{

    protected $code = 404;
    protected $message = 'Page Not Found!';

    /**
     * NotFoundException constructor.
     */
    public function __construct()
    {
        http_response_code($this->code);
    }
}
