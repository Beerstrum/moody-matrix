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
use Beerstrum\MoodyMatrix\Make;

class MakeTest extends TestAbstract {

    public function test_make_with_static_input() {
        $mock = $this->getMockBuilder('\Beerstrum\MoodyMatrix\CellMaker\Fixed')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('get_next_direction')
            ->willReturn(Config::LEFT);

        $maker = new Make($mock);
        $maker->build_new();
        $output = $maker->get_matrix();

        //TODO: Make this a method in TestAbstract
        $expected = unserialize(gzuncompress(file_get_contents($this->tests_root_dir.'Fixtures/MatrixAllLeft.gzraw')));

        $this->assertEquals($expected, $output);
    }
}
