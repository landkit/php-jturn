<?php

namespace LandKit\JTurn;

/**
 *
 */
class JForm implements JFormInterface
{
    use JTurnTrait;

    /**
     * Prevent creating a new JForm instance
     */
    private function __construct()
    {
    }

    /**
     * @param string $message
     * @param string $status
     * @return JForm
     */
    private static function attachFieldValidation(string $message, string $status): JForm
    {
        $message = !$message ? '' : JTurn::filter($message);

        foreach (JTurn::getSelectors() as $selector) {
            JTurn::$data[self::KEY][self::VALIDATOR][$status][$selector] = $message;
        }

        return new self;
    }

    /**
     * @param string $message
     * @return JForm
     */
    public static function validField(string $message = ''): JForm
    {
        return self::attachFieldValidation($message, self::VALIDATOR_VALID);
    }

    /**
     * @param string $message
     * @return JForm
     */
    public static function invalidField(string $message = ''): JForm
    {
        return self::attachFieldValidation($message, self::VALIDATOR_INVALID);
    }

    /**
     * @param string $behavior
     * @return JForm
     */
    private static function attachBehavior(string $behavior): JForm
    {
        if (!isset(JTurn::$data[self::KEY][self::BEHAVIOR])) {
            JTurn::$data[self::KEY][self::BEHAVIOR] = [];
        }

        if (!in_array($behavior, JTurn::$data[self::KEY][self::BEHAVIOR])) {
            JTurn::$data[self::KEY][self::BEHAVIOR][] = $behavior;
        }

        return new self;
    }

    /**
     * @return JForm
     */
    public static function keepFieldsDisabled(): JForm
    {
        return self::attachBehavior(self::BEHAVIOR_KEEP_DISABLED_FIELDS);
    }

    /**
     * @return JForm
     */
    public static function keepButtonDisabled(): JForm
    {
        return self::attachBehavior(self::BEHAVIOR_KEEP_DISABLED_BUTTON);
    }

    /**
     * @return JForm
     */
    public static function keepFieldsAndButtonDisabled(): JForm
    {
        return self::keepFieldsDisabled()::keepButtonDisabled();
    }

    /**
     * @return JForm
     */
    public static function keepFormDisabled(): JForm
    {
        return self::attachBehavior(self::BEHAVIOR_KEEP_DISABLED_FORM);
    }

    /**
     * @return JForm
     */
    public static function resetForm(): JForm
    {
        return self::attachBehavior(self::BEHAVIOR_RESET_FORM);
    }
}