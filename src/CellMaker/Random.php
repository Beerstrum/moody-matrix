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

class Random implements CellMakerInterface {

    protected $random_source;

    /** @var array $steps_array */
    protected $steps_array = [Config::UP, Config::RIGHT, Config::DOWN, Config::LEFT];

    public function __construct($seed = null) {

        if ($seed !== null) {
            mt_srand($seed);
        }

        $this->random_source = mt_rand(1, PHP_INT_MAX);
    }

    /**
     * @return int
     */
    public function get_next_direction() {

        if ($this->random_source <= 0) {
            $this->random_source = mt_rand(1, PHP_INT_MAX);
        }

        $roll                = $this->random_source % Config::DIRECTIONS;
        $this->random_source = $this->random_source >> 1;

        if (!isset($this->steps_array[$roll])) {
            trigger_error('Attempted to select a direction that does not exist.', E_USER_ERROR);
        }

        return $this->steps_array[$roll];
    }
}
