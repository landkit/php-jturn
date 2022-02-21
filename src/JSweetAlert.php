<?php

namespace LandKit\JTurn;

class JSweetAlert implements JSweetAlertInterface
{
    use JTurnTrait {
        JTurnTrait::selectors as private;
    }

    /**
     * @var array
     */
    private static $config = [
        'title' => '',
        'text' => '',
        'icon' => '',
        'session' => false
    ];

    /**
     * Prevent creating a new JSweetAlert instance
     */
    private function __construct()
    {
    }

    /**
     * @return void
     */
    private static function resetConfig()
    {
        self::$config = [
            'title' => '',
            'text' => '',
            'icon' => '',
            'session' => false
        ];
    }

    /**
     * @param string $value
     * @return JSweetAlert
     */
    public static function title(string $value): JSweetAlert
    {
        self::$config['title'] = JTurn::filter($value);
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function iconError(): JSweetAlert
    {
        self::$config['icon'] = self::ICON_ERROR;
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function iconInfo(): JSweetAlert
    {
        self::$config['icon'] = self::ICON_INFO;
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function iconQuestion(): JSweetAlert
    {
        self::$config['icon'] = self::ICON_QUESTION;
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function iconSuccess(): JSweetAlert
    {
        self::$config['icon'] = self::ICON_SUCCESS;
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function iconWarning(): JSweetAlert
    {
        self::$config['icon'] = self::ICON_WARNING;
        return new self;
    }

    /**
     * @param string $text
     * @return JSweetAlert
     */
    public static function buttonConfirm(string $text): JSweetAlert
    {
        self::$config['confirmButtonText'] = $text;
        return new self;
    }

    /**
     * @param string $text
     * @return JSweetAlert
     */
    public static function buttonDeny(string $text): JSweetAlert
    {
        self::$config['denyButtonText'] = $text;
        return new self;
    }

    /**
     * @param string $text
     * @return JSweetAlert
     */
    public static function buttonCancel(string $text): JSweetAlert
    {
        self::$config['cancelButtonText'] = $text;
        return new self;
    }

    /**
     * @return JSweetAlert
     */
    public static function session(): JSweetAlert
    {
        self::$config['session'] = true;
        return new self;
    }

    /**
     * @param string $text
     * @return JSweetAlert
     */
    public static function attach(string $text): JSweetAlert
    {
        self::$config['text'] = $text;

        $session = self::$config['session'];
        unset(self::$config['session']);

        if ($session) {
            $_SESSION['jturn'][self::KEY][] = self::$config;
        } else {
            JTurn::$data[self::KEY][] = self::$config;
        }

        self::resetConfig();
        return new self;
    }
}