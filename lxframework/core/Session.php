<?php


namespace app\core;


class Session
{
    const TYPE_FLASH = 'flash_messages';
    const TYPE_CART = 'cart';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();

        $flashMessages = $_SESSION[self::TYPE_FLASH] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            // mark to be removed
            $flashMessage['removed'] = true;
        }

        $_SESSION[self::TYPE_FLASH] = $flashMessages;
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
        return $_SESSION[self::TYPE_FLASH][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::TYPE_FLASH] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            // mark to be removed
            if ($flashMessage['removed']) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::TYPE_FLASH] = $flashMessages;
    }
}
