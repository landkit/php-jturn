<?php

namespace LandKit\JTurn;

abstract class JTurn
{
    /**
     * @var array
     */
    public static $data = [];

    /**
     * @var array
     */
    private static $selectors = [];

    /**
     * @return array
     */
    public static function getSelectors(): array
    {
        return self::$selectors;
    }

    /**
     * @param array|string $selectors
     * @param string $parent
     * @return void
     */
    public static function setSelectors($selectors, string $parent = '')
    {
        self::$selectors = [];

        if (!$selectors) {
            return;
        }

        $parent = !$parent ? '' : "$parent ";

        if (!is_array($selectors)) {
            $selectors = [$selectors];
        }

        foreach ($selectors as $selector) {
            self::$selectors[] = $parent . $selector;
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset(self::$data[$key]);
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function hasValue(string $key): bool
    {
        return !empty(self::$data[$key]);
    }

    /**
     * @param mixed $value
     * @return mixed|null
     */
    public static function filter($value)
    {
        if (is_array($value)) {
            return filter_var_array($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        } elseif (!is_int($value) && !is_float($value) && !is_bool($value)) {
            return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $value;
    }

    /**
     * @return void
     */
    public static function render()
    {
        echo json_encode(['jturn' => self::$data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}