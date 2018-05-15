<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\CellMaker;


use Beerstrum\MoodyMatrix\Config;
use Beerstrum\MoodyMatrix\Interfaces\CellMakerInterface;

class Fixed implements CellMakerInterface {

    protected $output;

    /**
     * Fixed constructor.
     *
     * Accepts an argument that is blindly returned for each cell.  Note: No validation is done here.
     * Should be one of config direction values: [UP | RIGHT | DOWN | LEFT]
     *
     * @param int $input
     */
    public function __construct($input = Config::UP) {
        $this->output = $input;
    }

    /**
     * @return int
     */
    public function get_next_direction() {
        return $this->output;
    }
}
