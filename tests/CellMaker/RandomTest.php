<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Tests\CellMaker;

use Beerstrum\MoodyMatrix\CellMaker\Random;
use Beerstrum\MoodyMatrix\Facts64;
use Beerstrum\MoodyMatrix\Tests\TestAbstract;

class RandomTest extends TestAbstract {

    public function test_static_output() {
        $object = new Random(123456789);

        $output = $object->get_next_direction();
        $this->assert_cell_values(Facts64::DOWN, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Facts64::LEFT, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Facts64::LEFT, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Facts64::LEFT, $output);
        $output = $object->get_next_direction();
        $this->assert_cell_values(Facts64::RIGHT, $output);
    }
}
