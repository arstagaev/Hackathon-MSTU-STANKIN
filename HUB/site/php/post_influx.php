<?php

$data = file_get_contents("http://pmelikov.ru:46050/csv/status.csv");
$rows = explode("\n",$data);
$s = array();
foreach($rows as $row) {
    $s[] = str_getcsv($row);
}

echo ($s[1][5])."\n";//ugarn gaz MQ-7
echo ($s[1][0])."\n";//propan MQ-5
echo ($s[1][1])."\n";//butan MQ-2
echo ($s[1][4])."\n";//spirt MQ-3

//$data =  'kvartira1,sensor=main,mesurement=voltage value='.$s[1][0];

send_to_influxdb('kvartira1,sensor_id=Fridge,mesurement=voltage value='.($s[1][5]));
send_to_influxdb('kvartira1,sensor_id=Fridge,mesurement=kilowatt value='.($s[1][0]));
send_to_influxdb('kvartira1,sensor_id=Heater,mesurement=voltage value='.($s[1][1]));
send_to_influxdb('kvartira1,sensor_id=Heater,mesurement=kilowatt value='.($s[1][4]));

send_to_influxdb('kvartira1,sensor_id=Xiaomi,mesurement=voltage value='.($s[1][5]));
send_to_influxdb('kvartira1,sensor_id=Xiaomi,mesurement=kilowatt value='.($s[1][0]));
send_to_influxdb('kvartira1,sensor_id=Android,mesurement=voltage value='.($s[1][1]));
send_to_influxdb('kvartira1,sensor_id=Android,mesurement=kilowatt value='.($s[1][4]));

send_to_influxdb('kvartira1,sensor_id=TV,mesurement=voltage value='.($s[1][5]));
send_to_influxdb('kvartira1,sensor_id=TV,mesurement=kilowatt value='.($s[1][0]));
send_to_influxdb('kvartira1,sensor_id=FAN,mesurement=voltage value='.($s[1][1]));
send_to_influxdb('kvartira1,sensor_id=FAN,mesurement=kilowatt value='.($s[1][4]));

send_to_influxdb('kvartira1,sensor_id=TeslaPowerWall,mesurement=voltage value='.($s[1][5]));
send_to_influxdb('kvartira1,sensor_id=TeslaPowerWall,mesurement=kilowatt value='.($s[1][0]));
send_to_influxdb('kvartira1,sensor_id=Light,mesurement=voltage value='.($s[1][1]));
send_to_influxdb('kvartira1,sensor_id=Light,mesurement=kilowatt value='.($s[1][4]));

send_to_influxdb('kvartira1,sensor_id=main,mesurement=kilowatt value='.(($s[1][0]+$s[1][4])*5));
function send_to_influxdb($data)
{

$url = 'http://pmelikov.ru:46086/write?db=test';

//$data =  'kvartira1,sensor=main,mesurement=voltage value='.$s[1][0];

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
'content' => $data
  )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, true, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);

}

?>
