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

    public function assert_cell_values($expected, $actual) {
        $config      = Config::init();
        $test_string = 'Expected:'.$config->direction_label($expected).' Actual:'.$config->direction_label($actual);

        $this->assertEquals($expected, $actual, $test_string);
    }

    /**
     * @param string $fixture_file_name
     *
     * @return mixed
     */
    public function get_fixture($fixture_file_name) {
        $path = getcwd().'/tests/Fixtures/'.$fixture_file_name;

        return unserialize(gzuncompress(file_get_contents($path)));
    }

    /**
     * @param string $fixture_file_name
     * @param mixed  $data
     *
     * @return bool|int
     */
    public function set_fixture($fixture_file_name, $data) {
        $path = getcwd().'/tests/Fixtures/'.$fixture_file_name;

        return file_put_contents($path, gzcompress(serialize($data)));
    }
}
