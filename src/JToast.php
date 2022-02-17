<?php

namespace LandKit\JTurn;

class JToast implements JToastInterface
{
    use JTurnTrait {
        JTurnTrait::selectors as private;
    }

    /**
     * @var array
     */
    private static $config = [
        'message' => '',
        'autohide' => true,
        'delay' => 7000,
        'session' => false
    ];

    /**
     * Prevent creating a new JToast instance
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
            'message' => '',
            'autohide' => true,
            'delay' => 5000,
            'session' => false
        ];
    }

    /**
     * @return JToast
     */
    public static function session(): JToast
    {
        self::$config['session'] = true;
        return new self;
    }

    /**
     * @param string $message
     * @param int $delay
     * @param bool $autohide
     * @return JToast
     */
    private static function attach(string $message, int $delay, bool $autohide): JToast
    {
        self::$config['message'] = JTurn::filter($message);
        self::$config['delay'] = $delay;
        self::$config['autohide'] = $autohide;

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

    /**
     * @param string $message
     * @param int $delay
     * @param bool $autohide
     * @return JToast
     */
    public static function default(string $message, int $delay = 7000, bool $autohide = true): JToast
    {
        return self::attach($message, $delay, $autohide);
    }
}