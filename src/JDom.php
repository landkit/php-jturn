<?php

namespace LandKit\JTurn;

class JDom implements JDomInterface
{
    use JTurnTrait;

    /**
     * Prevent creating a new JDom instance
     */
    private function __construct()
    {
    }

    /**
     * @param array|string $selectors
     * @param string $parent
     * @return JDom
     */
    public static function selectors($selectors, string $parent = ''): JDom
    {
        JTurn::setSelectors($selectors, $parent);
        return new self;
    }

    /**
     * @param array|string $classes
     * @param string $type
     * @return JDom
     */
    private static function attachClass($classes, string $type): JDom
    {
        if (!is_array($classes)) {
            $classes = [$classes];
        }

        foreach (JTurn::getSelectors() as $selector) {
            foreach ($classes as $class) {
                JTurn::$data[self::KEY][$selector][$type][] = $class;
            }
        }

        return new self;
    }

    /**
     * @param array|string $classes
     * @return JDom
     */
    public static function addClass($classes): JDom
    {
        return self::attachClass($classes, self::CLASS_ADD);
    }

    /**
     * @param array|string $classes
     * @return JDom
     */
    public static function removeClass($classes): JDom
    {
        return self::attachClass($classes, self::CLASS_REMOVE);
    }

    /**
     * @param array $attributes
     * @return JDom
     */
    public static function setAttribute(array $attributes): JDom
    {
        foreach (JTurn::getSelectors() as $selector) {
            foreach ($attributes as $name => $value) {
                JTurn::$data[self::KEY][$selector][self::ATTRIBUTE_SET][$name] = JTurn::filter($value);
            }
        }

        return new self;
    }

    /**
     * @param array|string $attributes
     * @return JDom
     */
    public static function removeAttribute($attributes): JDom
    {
        if (!is_array($attributes)) {
            $attributes = [$attributes];
        }

        foreach (JTurn::getSelectors() as $selector) {
            foreach ($attributes as $name) {
                JTurn::$data[self::KEY][$selector][self::ATTRIBUTE_REMOVE][] = $name;
            }
        }

        return new self;
    }

    /**
     * @param string $html
     * @param string $type
     * @return JDom
     */
    private static function attachChild(string $html, string $type): JDom
    {
        foreach (JTurn::getSelectors() as $selector) {
            JTurn::$data[self::KEY][$selector][$type][] = JTurn::filter($html);
        }

        return new self;
    }

    /**
     * @param string $html
     * @return JDom
     */
    public static function appendChild(string $html): JDom
    {
        return self::attachChild($html, self::CHILD_APPEND);
    }

    /**
     * @param string $html
     * @return JDom
     */
    public static function prependChild(string $html): JDom
    {
        return self::attachChild($html, self::CHILD_PREPEND);
    }

    /**
     * @param string $data
     * @param string $type
     * @return JDom
     */
    private static function attachInner(string $data, string $type): JDom
    {
        foreach (JTurn::getSelectors() as $selector) {
            JTurn::$data[self::KEY][$selector][$type] = JTurn::filter($data);
        }

        return new self;
    }

    /**
     * @param string $text
     * @return JDom
     */
    public static function innerText(string $text): JDom
    {
        return self::attachInner($text, self::INNER_TEXT);
    }

    /**
     * @param string $html
     * @return JDom
     */
    public static function innerHtml(string $html): JDom
    {
        return self::attachInner($html, self::INNER_HTML);
    }

    /**
     * @return JDom
     */
    public static function removeHtml(): JDom
    {
        foreach (JTurn::getSelectors() as $selector) {
            JTurn::$data[self::KEY][$selector][self::HTML_REMOVE] = true;
        }

        return new self;
    }

    /**
     * @param string $type
     * @return JDom
     */
    private static function attachModal(string $type): JDom
    {
        foreach (JTurn::getSelectors() as $selector) {
            JTurn::$data[self::KEY][$selector][$type] = true;
        }

        return new self;
    }

    /**
     * @return JDom
     */
    public static function showModal(): JDom
    {
        return self::attachModal(self::MODAL_SHOW);
    }

    /**
     * @return JDom
     */
    public static function hideModal(): JDom
    {
        return self::attachModal(self::MODAL_HIDE);
    }
}