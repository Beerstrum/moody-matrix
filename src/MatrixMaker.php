<?php

namespace Beerstrum\MoodyMatrix;


use Beerstrum\MoodyMatrix\Interfaces\CellMakerInterface;

class MatrixMaker {

    /** @var CellMakerInterface $cell_maker */
    protected $cell_maker;

    public function __construct(CellMakerInterface $cell_maker) {
        $this->cell_maker = $cell_maker;
    }

    /**
     * Creates a new matrix by the MatrixMaker CellMaker object set during construction.
     *
     * @param Config $config
     *
     * @return Matrix
     */
    public function build_new(Config $config) {
        $matrix = new Matrix($config);

        do {
            $matrix->set_current_cell($this->cell_maker->get_next_direction());
        } while ($matrix->scan());

        return $matrix;
    }
}
