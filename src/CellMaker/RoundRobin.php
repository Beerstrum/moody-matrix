<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\CellMaker;


use Beerstrum\MoodyMatrix\Facts64;
use Beerstrum\MoodyMatrix\Interfaces\CellMakerInterface;

class RoundRobin implements CellMakerInterface {

    const CLOCKWISE        = 1;
    const COUNTERCLOCKWISE = -1;

    /** @var int $direction */
    protected $direction;

    /** @var int $step_key */
    protected $step_key;
    /** @var array $steps_array */
    protected $steps_array = [Facts64::UP, Facts64::RIGHT, Facts64::DOWN, Facts64::LEFT];

    /** @var int $state */
    protected $state;

    /**
     * RoundRobin constructor.
     *
     * @param int $starting_cell_value Starting value for the round robin source.  Should be a Facts64 const direction. [UP | RIGHT | DOWN | LEFT]
     * @param int $direction           Which direction around are we going? [CLOCKWISE | COUNTERCLOCKWISE]
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($starting_cell_value = Facts64::UP, $direction = self::CLOCKWISE) {
        $this->state     = $starting_cell_value;
        $this->direction = $direction;

        $this->step_key = array_search($starting_cell_value, $this->steps_array);

        if ($this->step_key === false) {
            throw new \InvalidArgumentException('Value provided for starting_cell_value is not in the list of valid values.', 1);
        }
    }

    /**
     * @return int
     */
    public function get_next_direction() {
        $output = $this->state;

        if ($this->direction > 0) {
            $this->step_key = ($this->step_key + 1) % Facts64::DIRECTIONS;
        } else {

            if (--$this->step_key < 0) {
                $this->step_key = Facts64::DIRECTIONS - 1;
            }
        }

        $this->state = $this->steps_array[$this->step_key];

        return $output;
    }
}
