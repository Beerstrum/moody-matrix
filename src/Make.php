<?php

namespace Beerstrum\MoodyMatrix;


class Make {

    protected $matrix = [];

    protected $random_source = 0;

    public function build_new() {
        for ($h = 0; $h < Config::HEIGHT; $h++) {

            if (!empty($this->matrix[$h])) {
                $this->matrix[$h] = [];
            }

            for ($w = 0; $w < Config::WIDTH; $w++) {
                $this->populate_cell($h, $w);
            }
        }
    }

    protected function populate_cell($h, $w) {

        if ($this->random_source <= 0) {
            $this->random_source = mt_rand(1, PHP_INT_MAX);
        }

        $roll                = $this->random_source % Config::DIRECTIONS;
        $this->random_source = $this->random_source >> 1;

        switch (abs($roll)) {
            case 0:
                $this->matrix[$h][$w] = Config::UP;
                break;
            case 1:
                $this->matrix[$h][$w] = Config::RIGHT;
                break;
            case 2:
                $this->matrix[$h][$w] = Config::DOWN;
                break;
            case 3:
                $this->matrix[$h][$w] = Config::LEFT;
                break;
            default:
                user_error("Unexpected roll during cell population of $roll.", E_USER_ERROR);
                break;
        }
    }

    /**
     * @return array
     */
    public function get_matrix() {
        return $this->matrix;
    }
}
