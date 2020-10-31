<?php
 $filename = '../csv/status.csv';
// The nested array to hold all the arrays
$the_big_array = []; 
// Open the file for reading
if (($h = fopen("{$filename}", "r")) !== FALSE) 
{
  // Each line in the file is converted into an individual array that we call $data
  // The items of the array are comma separated
  while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
  {
    // Each individual array is being pushed into the nested array
    $the_big_array[] = $data;		
  }
  // Close the file
  fclose($h);
}

$data = array();
    
	//gas1_current
	for ($i = 0; $i <= 11; $i++) {
	$data["value".$i]=$the_big_array[1][$i];
	}
	
    if($the_big_array[1][12]){$data['status_of_heater'] = '1';} else{$data['status_of_heater'] = NULL;}
    if($the_big_array[1][13]){$data['status_of_light'] = '1';} else{$data['status_of_light'] = NULL;}
	if($the_big_array[1][14]){$data['status_of_ventilation'] = '1';} else{$data['status_of_ventilation'] = NULL;}
	if($the_big_array[1][15]){$data['status_of_humidifier'] = '1';} else{$data['status_of_humidifier'] = NULL;}	


$which_button_was_clicked = $_POST['button_id_that_was_clicked'];

$fpp = fopen("../csv/turn_on.csv", "r");
$contentt = fread($fpp,filesize("../csv/turn_on.csv"));
$content = explode(PHP_EOL, $contentt);
fclose ($fpp);

switch ($which_button_was_clicked) {


    case 0:
if ($the_big_array[1][12]) {$content[0] = 0;} else {$content[0] = 1;}
        break;

    case 1:
if ($the_big_array[1][13]) {$content[1] = 0;} else {$content[1] = 1;}
        break;

    case 2:
if ($the_big_array[1][14]) {$content[2] = 0;} else {$content[2] = 1;}
        break;

    case 3:
if ($the_big_array[1][15]) {$content[3] = 0;} else {$content[3] = 1;}
        break;
}

$fp = fopen("../csv/turn_on.csv", "w");
fwrite ($fp, implode(PHP_EOL,$content));
fclose ($fp);
?>
