<?php

namespace Beerstrum\MoodyMatrix;


use Beerstrum\MoodyMatrix\Goal\Edge;

class Tracker {

    /** @var Matrix $matrix */
    protected $matrix;

    /** @var array $path */
    protected $path = [];

    public function __construct(Matrix $matrix) {
        $this->matrix = $matrix;
    }

    /**
     * @param null|int $start_x
     * @param null|int $start_y
     *
     * @throws \OutOfBoundsException
     */
    public function traverse_to_edge($start_x = null, $start_y = null) {

        if (empty($start_x)) {
            $start_x = floor($this->matrix->get_width() / 2);
        }

        if (empty($start_y)) {
            $start_y = floor($this->matrix->get_height() / 2);
        }

        try {
            $this->matrix->set_location($start_x, $start_y);
        } catch (\OutOfBoundsException $e) {
            throw new \OutOfBoundsException('Failed to set starting location of matrix.', 1, $e);
        }

        $goal = new Edge($this->matrix);

        do {

            $location     = $this->matrix->get_location();
            $this->path[] = $location;

            try {
                $new_location = $this->matrix->step();
            } catch (\OutOfBoundsException $e) {
                trigger_error("Warning, abnormal end to traverse:".PHP_EOL.$e, E_USER_WARNING);
                break;
            } catch (\UnexpectedValueException $e) {
                trigger_error("Warning, abnormal end to traverse:".PHP_EOL.$e, E_USER_WARNING);
                break;
            }

            $found = $goal->goal_found($new_location);

        } while (!$found);
    }

    /**
     * @return array
     */
    public function get_path() {
        return $this->path;
    }
}
