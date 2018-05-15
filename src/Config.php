<?php

namespace Beerstrum\MoodyMatrix;

use Beerstrum\MoodyMatrix\Traits\SimpleSingleton;

class Config {
    use SimpleSingleton;

    const BIT_COUNT = 64;

    const UP      = 0b0000000000000001;
    const UP_MASK = 0b1111111111111111;

    const RIGHT      = 0b00000000000000010000000000000000;
    const RIGHT_MASK = 0b11111111111111110000000000000000;

    const DOWN      = 0b000000000000000100000000000000000000000000000000;
    const DOWN_MASK = 0b111111111111111100000000000000000000000000000000;

    const LEFT      = 0b0000000000000001000000000000000000000000000000000000000000000000;
    const LEFT_MASK = 0b1111111111111111000000000000000000000000000000000000000000000000;

    const HEIGHT     = 256;
    const WIDTH      = 256;
    const DIMENSIONS = 2;
    const DIRECTIONS = 4;

    /**
     * @param $input int A cell direction value in the range of a direction.  Can be any binary in the bits given to that direction.
     *
     * @return string Label for that direction.
     */
    public function direction_label($input) {

        if (self::UP_MASK & $input) {
            return 'UP';
        } else if (self::RIGHT_MASK & $input) {
            return 'RIGHT';
        } else if (self::DOWN_MASK & $input) {
            return 'DOWN';
        } else if (self::LEFT_MASK & $input) {
            return 'LEFT';
        } else {
            return 'UNKNOWN';
        }
    }
}
