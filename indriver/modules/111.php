<?php
class pointLocation {
    function pointLocation() {
    }
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {
        $vertices = $polygon;
        $intersections = 0;
        $vertices_count = count($vertices);
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1];
            $vertex2 = $vertices[$i];

            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) 
and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / 
($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }

        }
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }

}

$pointLocation = new pointLocation();
//$polygon = array(array('x'=>0,'y'=>0),array('x'=>4,'y'=>1),array('x'=>4,'y'=>4),array('x'=>1,'y'=>4),array('x'=>0,'y'=>0));
//$point = array('x'=>1,'y'=>0);
echo $pointLocation->pointInPolygon($point, $polygon);


?>
