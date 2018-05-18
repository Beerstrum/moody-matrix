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
use Beerstrum\MoodyMatrix\MatrixMaker;
use Beerstrum\MoodyMatrix\Mutation\TwistRight;
use Beerstrum\MoodyMatrix\Tracker;

class TrackerTest extends TestAbstract {

    /**
     * @group functional
     */
    public function test_edge_traversal() {
        $cell_maker   = new Random(123456);
        $cell_mutator = new TwistRight();
        $maker        = new MatrixMaker($cell_maker);

        $config = Config::init()
            ->set_height(48)
            ->set_width(48)
            ->set_mutator($cell_mutator);

        $matrix  = $maker->build_new($config);
        $tracker = new Tracker($matrix);

        $tracker->traverse_to_edge();

        $output = $tracker->get_path();

        //$this->set_fixture('PathRS123456_TwistRight_48x48.gzraw', $output);
        $expected = $this->get_fixture('PathRS123456_TwistRight_48x48.gzraw');

        $this->assertEquals($expected, $output);
    }

}
