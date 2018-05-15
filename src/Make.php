<?php

namespace Beerstrum\MoodyMatrix;


use Beerstrum\MoodyMatrix\Interfaces\CellMakerInterface;

class Make {

    protected $matrix = [];

    /** @var CellMakerInterface $cell_maker */
    protected $cell_maker;

    public function __construct(CellMakerInterface $cell_maker) {
        $this->cell_maker = $cell_maker;
    }

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
        $this->matrix[$h][$w] = $this->cell_maker->get_next_direction();
    }

    /**
     * @return array
     */
    public function get_matrix() {
        return $this->matrix;
    }
}
