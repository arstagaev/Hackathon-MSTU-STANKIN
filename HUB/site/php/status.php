<?php
/*	$fppp = fopen("./status/status.txt", "r");
	$statuss = fread($fppp,filesize("./status/status.txt"));
	$status = explode(PHP_EOL, $statuss);
	unset($statuss); //удаляет переменную contentt
	fclose ($fppp);
	
	$data = array();
    
    if($status[0]){$data['status_of_heater'] = '1';} else{$data['status_of_heater'] = NULL;}
    if($status[1]){$data['status_of_light'] = '1';} else{$data['status_of_light'] = NULL;}
	if($status[2]){$data['status_of_ventilation'] = '1';} else{$data['status_of_ventilation'] = NULL;}
	if($status[3]){$data['status_of_humidifier'] = '1';} else{$data['status_of_humidifier'] = NULL;}	
	//$data['current_temperature'] = $status[1];
	//$data['current_brightness'] = $status[4];
	
    //returns data as JSON format
    echo json_encode($data);*/
	
	

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
	//$value = "value".$i;


   // $value=$the_big_array[1][$i];
	$data["value".$i]=$the_big_array[1][$i];
//	echo $value;
	}
	
    if($the_big_array[1][12]){$data['status_of_heater'] = '1';} else{$data['status_of_heater'] = NULL;}
    if($the_big_array[1][13]){$data['status_of_light'] = '1';} else{$data['status_of_light'] = NULL;}
	if($the_big_array[1][14]){$data['status_of_ventilation'] = '1';} else{$data['status_of_ventilation'] = NULL;}
	if($the_big_array[1][15]){$data['status_of_humidifier'] = '1';} else{$data['status_of_humidifier'] = NULL;}	
	//$data['current_temperature'] = $status[1];
	//$data['current_brightness'] = $status[4];
	
    //returns data as JSON format
    echo json_encode($data);

//echo $the_big_array[1][12];

?>
