<?php
/*
$filename = '../csv/settings.csv';

$the_big_array = []; 

if (($h = fopen("{$filename}", "r")) !== FALSE) 
{

  while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
  {
    $the_big_array[] = $data;		
  }
  fclose($h);
}

$data = array();

	for ($i = 0; $i <= 23; $i++) 
	{
	$data[0]["input".$i]=$the_big_array[1][$i];
	}
	
	for ($i = 0; $i <= 8; $i++) 
	{
	if($the_big_array[2][$i]){$data[1]["checked".$i] = '1';} else{$data[1]["checked".$i] = NULL;}
	}
    //echo json_encode($data);
	echo $data[0][input5];*/
	
				
$array_checked = json_decode(stripslashes($_POST['json_array_checked']));
$array_input = json_decode(stripslashes($_POST['json_array_input']));
$settings = array (
    array("First_line-inputs", "Second_line-checkboxes"),
    $array_input,
	$array_checked
);

$fp = fopen('../csv/settings.csv', 'w');

foreach ($settings as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

?>