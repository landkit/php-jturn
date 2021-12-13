<?php

namespace LandKit\JTurn;

interface JFormInterface
{
    /**
     * @const string
     */
    const KEY = 'form';

    /**
     * @const string
     */
    const VALIDATOR = 'validators';

    /**
     * @const string
     */
    const VALIDATOR_INVALID = 'invalid';

    /**
     * @const string
     */
    const VALIDATOR_VALID = 'valid';

    /**
     * @const string
     */
    const BEHAVIOR = 'behaviors';

    /**
     * @const string
     */
    const BEHAVIOR_KEEP_DISABLED_BUTTON = 'keepButtonDisabled';

    /**
     * @const string
     */
    const BEHAVIOR_KEEP_DISABLED_FIELDS = 'keepFieldsDisabled';

    /**
     * @const string
     */
    const BEHAVIOR_RESET_FORM = 'reset';
}