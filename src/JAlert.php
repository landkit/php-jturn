<?php

namespace LandKit\JTurn;

class JAlert implements JAlertInterface
{
    use JTurnTrait;

    /**
     * @var array
     */
    private static $config = [
        'message' => '',
        'type' => '',
        'dismissible' => false,
        'session' => false
    ];

    /**
     * Prevent creating a new JAlert instance
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
            'type' => '',
            'dismissible' => false,
            'session' => false
        ];
    }

    /**
     * @return JAlert
     */
    public static function dismissible(): JAlert
    {
        self::$config['dismissible'] = true;
        return new self;
    }

    /**
     * @return JAlert
     */
    public static function session(): JAlert
    {
        self::$config['session'] = true;
        return new self;
    }

    /**
     * @param string $message
     * @param string $type
     * @return JAlert
     */
    private static function attach(string $message, string $type): JAlert
    {
        self::$config['message'] = JTurn::filter($message);
        self::$config['type'] = $type;

        foreach (JTurn::getSelectors() as $selector) {
            $session = self::$config['session'];
            unset(self::$config['session']);

            if ($session) {
                $_SESSION['jturn'][self::KEY][$selector][] = self::$config;
            } else {
                JTurn::$data[self::KEY][$selector][] = self::$config;
            }
        }

        self::resetConfig();
        return new self;
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function black(string $message): JAlert
    {
        return self::attach($message, self::TYPE_BLACK);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function danger(string $message): JAlert
    {
        return self::attach($message, self::TYPE_DANGER);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function dark(string $message): JAlert
    {
        return self::attach($message, self::TYPE_DARK);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function info(string $message): JAlert
    {
        return self::attach($message, self::TYPE_INFO);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function light(string $message): JAlert
    {
        return self::attach($message, self::TYPE_LIGHT);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function primary(string $message): JAlert
    {
        return self::attach($message, self::TYPE_PRIMARY);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function secondary(string $message): JAlert
    {
        return self::attach($message, self::TYPE_SECONDARY);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function success(string $message): JAlert
    {
        return self::attach($message, self::TYPE_SUCCESS);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function warning(string $message): JAlert
    {
        return self::attach($message, self::TYPE_WARNING);
    }

    /**
     * @param string $message
     * @return JAlert
     */
    public static function white(string $message): JAlert
    {
        return self::attach($message, self::TYPE_WHITE);
    }
}