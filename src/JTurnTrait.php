<?php

namespace LandKit\JTurn;

trait JTurnTrait
{
    /**
     * @param array|string $selectors
     * @param string $parent
     * @return $this
     */
    public static function selectors($selectors, string $parent = '')
    {
        JTurn::setSelectors($selectors, $parent);
        return new self;
    }

    /**
     * @return bool
     */
    public static function exists(): bool
    {
        return isset(JTurn::$data[self::KEY]);
    }

    /**
     * @return void
     */
    public static function render()
    {
        JTurn::render();
    }
}