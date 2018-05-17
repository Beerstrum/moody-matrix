<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Tests;


use Beerstrum\MoodyMatrix\CellMaker\Random;
use Beerstrum\MoodyMatrix\Config;
use Beerstrum\MoodyMatrix\Make;

class MakeTest extends TestAbstract {

    /**
     * @group unit
     */
    public function test_make_with_static_input() {
        $mock = $this->getMockBuilder('\Beerstrum\MoodyMatrix\CellMaker\Fixed')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('get_next_direction')
            ->willReturn(Config::LEFT);

        $maker = new Make($mock);
        $maker->build_new();
        $output = $maker->get_matrix();

        $expected = $this->get_fixture('MatrixAllLeft.gzraw');

        $this->assertEquals($expected, $output);
    }

    /**
     * @group functional
     */
    public function test_make_random_functional() {
        $cell_maker = new Random(123456);
        $maker      = new Make($cell_maker);

        $maker->build_new();

        $output   = $maker->get_matrix();
        $expected = $this->get_fixture('MatrixRandomS123456.gzraw');

        $this->assertEquals($expected, $output);
    }
}
