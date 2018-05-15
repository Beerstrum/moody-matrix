<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Tests;

use Beerstrum\MoodyMatrix\Config;

class TestAbstract extends \PHPUnit_Framework_TestCase {

    public $tests_root_dir;

    public function setUp() {
        $this->tests_root_dir = getcwd().'/tests/';
    }

    public function assert_cell_values($expected, $actual) {
        $config      = Config::init();
        $test_string = 'Expected:'.$config->direction_label($expected).' Actual:'.$config->direction_label($actual);

        $this->assertEquals($expected, $actual, $test_string);
    }
}
