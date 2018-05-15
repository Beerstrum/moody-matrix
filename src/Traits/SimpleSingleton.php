<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Traits;


/**
 * Trait SimpleSingleton
 *
 * Use this trait to quickly and easily setup a single instance singleton.  These types of objects only have 1 instance.
 */
trait SimpleSingleton {

    protected static $instance = null;

    /**
     * Return an existing class instance, or create a new instance, set it, and then return it.
     *
     * @return $this
     */
    public static function init() {

        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Sets the internal static instance of this class to null.
     */
    public static function destroy() {
        self::$instance = null;
    }

    /**
     * Non-public constructor to enforce instance control.
     */
    protected function __construct() {
    }

    /**
     * Non-public clone to enforce instance control.
     */
    protected function __clone() {
    }
}
