<?php

namespace Beerstrum\MoodyMatrix;


class Measure {
    protected $matrix = [];

    protected $position_h;
    protected $position_w;

    protected $path = [];

    public function traverse() {
        $this->start();

        while (
            $this->position_h > 0 &&
            $this->position_h < Config::HEIGHT &&
            $this->position_w > 0 &&
            $this->position_w < Config::WIDTH
        ) {
            $this->step();
        }
    }

    public function step() {

        if ($this->matrix[$this->position_h][$this->position_w] & Config::UP_MASK) {
            $this->matrix[$this->position_h][$this->position_w] = Config::RIGHT;
            $this->position_h--;
        } else if ($this->matrix[$this->position_h][$this->position_w] & Config::RIGHT_MASK) {
            $this->matrix[$this->position_h][$this->position_w] = Config::DOWN;
            $this->position_w++;
        } else if ($this->matrix[$this->position_h][$this->position_w] & Config::DOWN_MASK) {
            $this->matrix[$this->position_h][$this->position_w] = Config::LEFT;
            $this->position_h++;
        } else if ($this->matrix[$this->position_h][$this->position_w] & Config::LEFT_MASK) {
            $this->matrix[$this->position_h][$this->position_w] = Config::UP;
            $this->position_w--;
        } else {
            user_error("Unexpected value in matrix at position {$this->position_h}, {$this->position_w}", E_USER_ERROR);
        }

        $this->record_step();
    }

    protected function record_step() {
        $this->path[] = [$this->position_h, $this->position_w];
    }

    public function start() {
        $this->position_h = floor(Config::HEIGHT / 2);
        $this->position_w = floor(Config::WIDTH / 2);

        $this->path = [];
    }

    /**
     * @return array
     */
    public function get_path() {
        return $this->path;
    }

    /**
     * @param array $matrix
     */
    public function set_matrix(array $matrix) {
        $this->matrix = $matrix;
    }
}
