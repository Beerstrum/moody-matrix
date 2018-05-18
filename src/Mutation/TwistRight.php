<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix\Mutation;

use Beerstrum\MoodyMatrix\Facts64;
use Beerstrum\MoodyMatrix\Interfaces\MutationInterface;

class TwistRight implements MutationInterface {

    public function mutate_cell($cell_current_state) {

        if ($cell_current_state & Facts64::UP_MASK) {
            return Facts64::RIGHT;
        } else if ($cell_current_state & Facts64::RIGHT_MASK) {
            return Facts64::DOWN;
        } else if ($cell_current_state & Facts64::DOWN_MASK) {
            return Facts64::LEFT;
        } else if ($cell_current_state & Facts64::LEFT_MASK) {
            return Facts64::UP;
        }

        return $cell_current_state;
    }
}
