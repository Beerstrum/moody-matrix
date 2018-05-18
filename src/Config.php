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

class Config {

    protected $height = 256;
    protected $width  = 256;

    /** @var MutationInterface $mutator */
    protected $mutator = null;

    /**
     * @param int $height
     *
     * @return Config
     */
    public function set_height($height) {
        $this->height = (int)$height;

        return $this;
    }

    /**
     * @param int $width
     *
     * @return Config
     */
    public function set_width($width) {
        $this->width = (int)$width;

        return $this;
    }

    /**
     * @param MutationInterface $mutator
     *
     * @return Config
     */
    public function set_mutator(MutationInterface $mutator) {
        $this->mutator = $mutator;

        return $this;
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
     * @return MutationInterface
     */
    public function get_mutator() {
        return $this->mutator;
    }

    public static function init() {
        return new self;
    }
}
