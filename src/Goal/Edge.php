<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Goal;


use Beerstrum\MoodyMatrix\Interfaces\GoalInterface;
use Beerstrum\MoodyMatrix\Matrix;

class Edge implements GoalInterface {

    protected $matrix;

    public function __construct(Matrix $matrix) {
        $this->matrix = $matrix;
    }

    public function goal_found(\SplFixedArray $location) {

        if (
            $location[0] <= 0
            || $location[1] <= 0
            || $location[0] >= $this->matrix->get_width()
            || $location[1] >= $this->matrix->get_width()
        ) {
            return true;
        } else {
            return false;
        }
    }
}
