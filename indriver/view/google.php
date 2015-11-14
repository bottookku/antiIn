<?php
if(!is_null($_GET['add']))
{
	$_GET['add'] = str_replace(" ","+",$_GET['add']);
	$ssd = implode(file("https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Якутск+".$_GET['add']."&types=establishment&location=62.0295456,129.7357129&radius=15000&components=country:ru&language=ru&key=AIzaSyAWkouUB9kYpW8N8B9mWoMRi5apxcn72u8"));
	$sd = json_decode($ssd);
	foreach($sd->predictions as $key => $ss)
	{
		foreach($ss->terms as $ss2)
		{
			if($ss2->value == "Якутск")
			{
				$suka[]=$ss;
				break;
			}
		}

	}

	foreach($suka as $ssd)
	{
		$ss = str_replace(", Якутск","",$ssd->description);
		$ss = str_replace(", Россия","",$ss);
		$ss = str_replace(", Республика Саха (Якутия)","",$ss);
		$place = $ssd->place_id;
		$sq[] = array('label' =>$ss, 'value'=>$place);
	}
	echo json_encode($sq);
}

if(!is_null($_GET['place']))

{
	$ssd = implode(file("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$_GET['place']."&key=AIzaSyAWkouUB9kYpW8N8B9mWoMRi5apxcn72u8&language=ru"));
	$sd = json_decode($ssd);
	//print_r($sd);
	//Якутская ул., 2, Якутск, Респ. Саха (Якутия), Россия, 677000
	//2, ул. Ушакова, г. Якутск, Республика Саха (Якутия), Россия 677000, Россия
	//пр. Ленина, 8, Якутск, Россия, 677000
	$add = $sd->result->formatted_address;

	$add = str_replace(", Якутск","",$add);
	$add = str_replace(", Россия","",$add);
	$add = str_replace(", Республика Саха (Якутия)","",$add);
	$add = str_replace(", Респ. Саха (Якутия)","",$add);
	$add = str_replace(", 677000","",$add);
	$add = str_replace(", г. Якутск","",$add);
	$add = str_replace("677000","",$add);



	$lat = $sd->result->geometry->location->lat;
	$lng = $sd->result->geometry->location->lng;
	$ddd = array('add'=>$add,'lat'=>$lat,'lng'=>$lng);
	echo json_encode($ddd);

}

if(!is_null($_GET['region']))
{
class pointLocation {
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?
 
    function pointLocation() {
    }
 
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {
        $this->pointOnVertex = $pointOnVertex;
 
        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array(); 
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex); 
        }
 
        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }
 
        // Check if the point is inside the polygon or on the boundary
        $intersections = 0; 
        $vertices_count = count($vertices);
 
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 
        // If the number of edges we passed through is odd, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }
 
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }
 
    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }
 
}







//////////////////
/////ПРоверка/////
//////////////////
$pointLocation = new pointLocation();
$points = array("50 70","70 40","-20 30","100 10","-10 -10","40 -20","110 -20");
$polygon = array("-50 30","50 70","100 50","80 10","110 -10","110 -30","-20 -50","-30 -40","10 -10","-10 10","-30 -20","-50 30");
// The last point's coordinates must be the same as the first one's, to "close the loop"
foreach($points as $key => $point) {
    echo "point " . ($key+1) . " ($point): " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
}

}

?>
