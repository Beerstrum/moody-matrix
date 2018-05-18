<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Beerstrum\MoodyMatrix;


use Beerstrum\MoodyMatrix\Interfaces\MutationInterface;
use Beerstrum\MoodyMatrix\Mutation\Stable;

class Matrix {
    /** @var \SplFixedArray $data */
    protected $data;

    /** @var int $cell_pointer_y */
    protected $cell_pointer_y = 0;
    /** @var int $cell_pointer_x */
    protected $cell_pointer_x = 0;

    protected $height;
    protected $width;

    /** @var MutationInterface $mutation */
    protected $mutation;

    /**
     * Matrix constructor.
     *
     * @param Config                 $config
     */
    public function __construct(Config $config) {
        $this->height = $config->get_height();
        $this->width  = $config->get_width();

        if (!empty($config->get_mutator())) {
            $this->mutation = $config->get_mutator();
        } else {
            $this->mutation = new Stable();
        }

        $this->initialize_arrays();
    }

    /**
     * Creates the fixed arrays for the matrix.
     */
    protected function initialize_arrays() {

        $this->data = new \SplFixedArray($this->height);

        for ($h = 0; $h < $this->height; $h++) {
            $this->data[$h] = new \SplFixedArray($this->width);
        }
    }

    /**
     * Moves the internal pointer to a new location of the matrix, following a reading order pattern of
     * top left corner, left to right, to the bottom right corner.  Once it hits the end of the scan pattern,
     * the return value will change from true to false.
     *
     *  01->02->03->04->05->06->07
     *  08->09->10->11->12->13->14
     *  ...
     *
     * @return bool
     */
    public function scan() {

        if ($this->cell_pointer_x < $this->width - 1) {
            $this->cell_pointer_x++;
        } else if ($this->cell_pointer_y < $this->height - 1) {
            $this->cell_pointer_x = 0;
            $this->cell_pointer_y++;
        } else {
            return false;
        }

        return true;
    }

    /**
     * Moves the internal pointer by the rules of the current cell, following the direction and moving to a new cell.
     *
     * @throws \UnexpectedValueException
     * @throws \OutOfBoundsException
     */
    public function step() {

        if (!isset($this->data[$this->cell_pointer_x][$this->cell_pointer_y])) {
            throw new \OutOfBoundsException("Current location ({$this->cell_pointer_x}, {$this->cell_pointer_y}) is not a valid cell.", 2);
        }

        $current_x = $this->cell_pointer_x;
        $current_y = $this->cell_pointer_y;

        if ($this->data[$this->cell_pointer_x][$this->cell_pointer_y] & Facts64::UP_MASK) {
            $this->cell_pointer_y++;
        } else if ($this->data[$this->cell_pointer_x][$this->cell_pointer_y] & Facts64::RIGHT_MASK) {
            $this->cell_pointer_x++;
        } else if ($this->data[$this->cell_pointer_x][$this->cell_pointer_y] & Facts64::DOWN_MASK) {
            $this->cell_pointer_y--;
        } else if ($this->data[$this->cell_pointer_x][$this->cell_pointer_y] & Facts64::LEFT_MASK) {
            $this->cell_pointer_x--;
        } else {
            throw new \UnexpectedValueException("Unexpected value in matrix at position {$this->cell_pointer_x}, {$this->cell_pointer_y}", 1);
        }

        $this->data[$current_x][$current_y] = $this->mutation->mutate_cell($this->data[$current_x][$current_y]);

        return $this->get_location();
    }

    /**
     * Sets the current location to a value.  Should be one of Facts direction values: [UP | RIGHT | DOWN | LEFT]
     *
     * @param int $input Sets the currently pointed at cell to this input.
     */
    public function set_current_cell($input) {
        $this->data[$this->cell_pointer_y][$this->cell_pointer_x] = $input;
    }

    /**
     * @param int $x The coordinate to set the X axis to.
     * @param int $y The coordinate to set the Y axis to.
     *
     * @throws \OutOfBoundsException
     */
    public function set_location($x = null, $y = null) {

        if (isset($x)) {
            $x = (int)$x;

            if ($x >= 0 && $x < $this->width) {
                $this->cell_pointer_x = $x;
            } else {
                throw new \OutOfBoundsException("X coordinate provided ($x) is outside this matrix (width: {$this->width}).", 1);
            }
        }

        if (isset($y)) {

            if ($y >= 0 && $y < $this->width) {
                $this->cell_pointer_y = $y;
            } else {
                throw new \OutOfBoundsException("Y coordinate provided ($y) is outside this matrix (height: {$this->height}).", 2);
            }
        }
    }

    /**
     * @return \SplFixedArray
     */
    public function get_location() {
        $location    = new \SplFixedArray(2);
        $location[0] = $this->cell_pointer_x;
        $location[1] = $this->cell_pointer_y;

        return $location;
    }

    /**
     * @return int
     */
    public function get_height() {
        return $this->height;
    }

    /**
     * @return int
     */
    public function get_width() {
        return $this->width;
    }

    /**
     * @return \SplFixedArray
     */
    public function get_raw_matrix_data() {
        return $this->data;
    }
}
