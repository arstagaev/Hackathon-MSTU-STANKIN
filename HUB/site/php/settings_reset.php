<?php
$settings = array (
    array("First_line-inputs", "Second_line-checkboxes"),
     array(200,5000,300,5000,500,20000,300,5000,25,5220,20,2000,+18,+30,0,100,0,65535,+18,+30,0,100,0,65535,admin,admin),
	 array(1,1,1,1,1,1,1,1,1),
);
$fp = fopen('../csv/settings.csv', 'w');
foreach ($settings as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);
?>