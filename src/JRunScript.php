<?php

namespace LandKit\JTurn;

class JRunScript implements JRunScriptInterface
{
    use JTurnTrait {
        JTurnTrait::selectors as private;
    }

    /**
     * Prevent creating a new JRunScript instance
     */
    private function __construct()
    {
    }

    /**
     * @param string $type
     * @param string $script
     * @return JRunScript
     */
    private static function attach(string $type, string $script): JRunScript
    {
        JTurn::$data[self::KEY][$type][] = JTurn::filter($script);
        return new self;
    }

    /**
     * @param string $script
     * @return JRunScript
     */
    public static function javascript(string $script): JRunScript
    {
        return self::attach(self::JAVASCRIPT, $script);
    }
}