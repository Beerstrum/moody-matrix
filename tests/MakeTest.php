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
use Beerstrum\MoodyMatrix\CellMaker\RoundRobin;
use Beerstrum\MoodyMatrix\Config;
use Beerstrum\MoodyMatrix\Facts64;
use Beerstrum\MoodyMatrix\MatrixMaker;

class MakeTest extends TestAbstract {

    /**
     * @group functional
     */
    public function test_make_random_functional() {
        $cell_maker = new Random(123456);
        $maker      = new MatrixMaker($cell_maker);

        $config = Config::init()
            ->set_height(48)
            ->set_width(48);

        $matrix = $maker->build_new($config);

        //$this->set_fixture('MatrixRandomS123456.gzraw', $matrix->get_raw_matrix_data());
        $expected = $this->get_fixture('MatrixRandomS123456.gzraw');

        $this->assertEquals($expected, $matrix->get_raw_matrix_data());
    }

    public function test_make_round_robin_functional() {
        $cell_maker = new RoundRobin(Facts64::DOWN, RoundRobin::CLOCKWISE);
        $maker      = new MatrixMaker($cell_maker);

        $config = Config::init()
            ->set_height(48)
            ->set_width(48);

        $matrix = $maker->build_new($config);

        //$this->set_fixture('MatrixRoundRobinDClockwise.gzraw', $matrix->get_raw_matrix_data());
        $expected = $this->get_fixture('MatrixRoundRobinDClockwise.gzraw');

        $this->assertEquals($expected, $matrix->get_raw_matrix_data());
    }
}
