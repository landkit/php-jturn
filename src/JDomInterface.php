<?php

namespace LandKit\JTurn;

interface JDomInterface
{
    /**
     * @const string
     */
    const KEY = 'dom';

    /**
     * @const string
     */
    const CLASS_ADD = 'addClass';

    /**
     * @const string
     */
    const CLASS_REMOVE = 'removeClass';

    /**
     * @const string
     */
    const ATTRIBUTE_SET = 'setAttribute';

    /**
     * @const string
     */
    const ATTRIBUTE_REMOVE = 'removeAttribute';

    /**
     * @const string
     */
    const CHILD_PREPEND = 'prependChild';

    /**
     * @const string
     */
    const CHILD_APPEND = 'appendChild';

    /**
     * @const string
     */
    const INNER_HTML = 'innerHtml';

    /**
     * @const string
     */
    const INNER_TEXT = 'innerText';

    /**
     * @const string
     */
    const HTML_REMOVE = 'removeHtml';

    /**
     * @const string
     */
    const MODAL_SHOW = 'modalShow';

    /**
     * @const string
     */
    const MODAL_HIDE = 'modalHide';
}