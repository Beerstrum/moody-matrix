<?php

namespace Beerstrum\MoodyMatrix;


class SVG {

    public function cords_to_path(array $cords) {
        $start  = array_shift($cords);
        $output = "M{$start[0]} {$start[1]}";

        foreach ($cords as $point) {
            $output .= " L {$point[0]} {$point[1]}";
        }

        return $output;
    }
}
