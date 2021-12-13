<?php

namespace LandKit\JTurn;

class JAlert implements JAlertInterface
{
    use JTurnTrait;

    /**
     * @var array
     */
    private static $config = [
        'content' => '',
        'color' => '',
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
            'content' => '',
            'color' => '',
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
     * @param string $content
     * @param string $color
     * @return JAlert
     */
    private static function attach(string $content, string $color): JAlert
    {
        self::$config['content'] = JTurn::filter($content);
        self::$config['color'] = $color;

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
     * @param string $content
     * @return JAlert
     */
    public static function black(string $content): JAlert
    {
        return self::attach($content, self::COLOR_BLACK);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function danger(string $content): JAlert
    {
        return self::attach($content, self::COLOR_DANGER);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function dark(string $content): JAlert
    {
        return self::attach($content, self::COLOR_DARK);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function info(string $content): JAlert
    {
        return self::attach($content, self::COLOR_INFO);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function light(string $content): JAlert
    {
        return self::attach($content, self::COLOR_LIGHT);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function primary(string $content): JAlert
    {
        return self::attach($content, self::COLOR_PRIMARY);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function secondary(string $content): JAlert
    {
        return self::attach($content, self::COLOR_SECONDARY);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function success(string $content): JAlert
    {
        return self::attach($content, self::COLOR_SUCCESS);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function warning(string $content): JAlert
    {
        return self::attach($content, self::COLOR_WARNING);
    }

    /**
     * @param string $content
     * @return JAlert
     */
    public static function white(string $content): JAlert
    {
        return self::attach($content, self::COLOR_WHITE);
    }
}