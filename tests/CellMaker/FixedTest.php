<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Tests\CellMaker;


use Beerstrum\MoodyMatrix\CellMaker\Fixed;
use Beerstrum\MoodyMatrix\Config;
use Beerstrum\MoodyMatrix\Tests\TestAbstract;

class FixedTest extends TestAbstract {

    public function test_static_output() {
        $object = new Fixed(Config::DOWN);

        $output = $object->get_next_direction();
        $this->assert_cell_values(Config::DOWN, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Config::DOWN, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Config::DOWN, $output);
    }
}
