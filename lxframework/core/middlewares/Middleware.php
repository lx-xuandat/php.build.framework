<?php


namespace app\core\middlewares;


abstract class Middleware
{
    public array $actions = [];

    abstract public function execute();
}
