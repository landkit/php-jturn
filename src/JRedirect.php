<?php

namespace LandKit\JTurn;

class JRedirect implements JRedirectInterface
{
    use JTurnTrait {
        JTurnTrait::selectors as private;
    }

    /**
     * Prevent creating a new JRedirect instance
     */
    private function __construct()
    {
    }

    /**
     * @param string $type
     * @param string $url
     * @return JRedirect
     */
    private static function attach(string $type, string $url): JRedirect
    {
        JTurn::$data[self::KEY] = [
            'type' => $type,
            'url' => filter_var($url, FILTER_SANITIZE_URL)
        ];

        return new self;
    }

    /**
     * @param string $url
     * @return JRedirect
     */
    public static function self(string $url): JRedirect
    {
        return self::attach(self::TYPE_SELF, $url);
    }

    /**
     * @param string $url
     * @return JRedirect
     */
    public static function blank(string $url): JRedirect
    {
        return self::attach(self::TYPE_BLANK, $url);
    }
}