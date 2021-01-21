<?php


namespace app\core;


class Session
{
    public const TYPE_FLASH = 'flash_messages';
    public const TYPE_CART = 'cart';

    public const KEY_SUCCESS = 'success';


    /**
     * Session constructor.
     */
    public function __construct()
    {
        // session_save_path("/tmp");

        session_start();

        $flashMessages = $_SESSION[self::TYPE_FLASH] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            // mark to be removed
            $flashMessages['removed'] = true;
        }

        $_SESSION[self::TYPE_FLASH] = $flashMessages;

        echo '<pre>';
        var_dump($_SESSION[self::TYPE_FLASH]);
        echo '</pre>';

    }

    public function setFlash($key, $messages)
    {
        $_SESSION[self::TYPE_FLASH][$key] = [
            'value' => $messages,
            'removed' => false,
        ];
    }

    public function getFlash($key)
    {
//        return $_SESSION[self::TYPE_FLASH][$key];
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
