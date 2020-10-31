<!DOCTYPE html>
<html lang="ru">
<head>
	<link href="./img/stankin_logo.jpg" rel="icon" type="image/x-icon">
	<link href="./css/style.css" rel="stylesheet">
	<title>Цифровой прорыв-2020</title>
	<meta charset="utf-8">
	<script src="/node_modules/jquery/dist/jquery.min.js">
	</script>
	<script type="text/javascript">
 /*КОД НИЖЕ ОТВЕЧАЕТ ЗА ФОТО-ТРАНСЛЯЦИЮ*/
	 function imgError(image) {
	   image.onerror = "";
	   image.src = "no_image.jpg";
	   return true;
	}

	var imageNr = 0; // Serial number of current image
	var finished = new Array(); // References to img objects which have finished downloading

	function createImageLayer() {
	   //no_webcam.style.visibility='hidden'; 
	   //no_webcam.style.zIndex = -2;
	 var img = new Image();
	 img.style.position = "absolute";
	 img.style.zIndex = -1;
	 img.width = document.getElementById("content").offsetWidth; //устанавливает ширину картинки = ширине wrappera,а он занимает всю мою страницу
	img.onload = imageOnload;
	 img.src = "/stream" + (++imageNr);
	 var webcam = document.getElementById("webcam");
	webcam.insertBefore(img, webcam.firstChild);
	}

	// Two layers are always present (except at the very beginning), to avoid flicker
	function imageOnload() {
	 this.style.zIndex = imageNr; // Image finished, bring to front!
	 while (1 < finished.length) {
	   var del = finished.shift(); // Delete old image(s) from document
	   del.parentNode.removeChild(del);
	 }
	 finished.push(this);
	createImageLayer();
	}

	</script>
</head>
<?php
  $filename = './csv/status.csv';

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
	for ($i = 0; $i <= 11; $i++) {
	$data["value".$i]=$the_big_array[1][$i];
	}

$filename = './csv/settings.csv';
$the_big_array2 = []; 
if (($h = fopen("{$filename}", "r")) !== FALSE) 
{
  while (($data2 = fgetcsv($h, 1000, ",")) !== FALSE) //чтение текущих настроек
  {
    $the_big_array2[] = $data2;		
  }
  fclose($h);
}

?>

<body onload="createImageLayer();">

	<table width="100%">
		<tr>
			<td style="text-align: center; width="><img height="15%" src="./img/hack_logo.jpg"></td>
			<td style="text-align: center; width=">
				<p style="font-size:160%; font-weight: bold;"><nobr>Мониторинг и диспетчеризация</nobr></p>
				<p style="font-size:120%; font-weight: bold;"><nobr>потребления электроэнергии</nobr></p>
			</td>
		</tr>
	</table>
	<!-- МЕНЮ -->
	<div class="top-menu-handler" style="text-align: center;">
		<div class="top-menu">
			<ul>
				<li>
					<a href="index_hack.php">Терминал</a>
				</li>
				<li>
					<a href="statistics-hack.php">Статистика</a>
				</li>
				<li>
					<a href="system_settings-hack.php">Настройки</a> <!--<ul>
                <li><a href="access_settings.php">Доступ</a></li>
                <li><a href="system_settings.php">Система</a></li>
            </ul>-->
				</li>
				<li>
					<a href="about_system-hack.html">О системе</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- МЕНЮ -->
	<!-- ФОТО ТРАНСЛЯЦИЯ -->
	<div id="content">
		<div id="wrapper">
			<div id="webcam"><img width="100%" id="stream_img" onerror="imgError(this);" src="/stream"></div>
		</div>
		<table style="background-color: #F8F8F8; width: 100%;">
			<tr>
				<td colspan="3">
					<p style="text-align: center; font-size:120%; font-weight: bold;">Датчик 1:</p>
				</td>
			</tr>
			<tr>
			<!-- ДАТЧИК 1 -->
				<td>
					<div class="range_contaner">
						<div class="range" id="range5_handler"
						<?php 
						if (/*$the_big_array2[1][10] > $data["value5"] || */$the_big_array2[1][11] < $data["value5"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Напряжение:</p><input disabled id="range5" max="<?php echo $the_big_array2[1][11]?>" min="<?php echo $the_big_array2[1][10]?>" type="range" value="<?php echo $data["value5"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][10]?></span> <span id="range5_value_text" style="margin-top: 7px"><?php echo $data["value5"]." Вольт"; ?></span> <span class="tick"><?php echo $the_big_array2[1][11]?></span>
							</div>
						</div>
					</div>
				</td>



				<td>
					<div class="range_contaner" >
						<div class="range" id="range0_handler"
						<?php 
						if (/*$the_big_array2[1][0] > $data["value0"] || */$the_big_array2[1][1] < $data["value0"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Мощность:</p><input disabled id="range0" max="<?php echo $the_big_array2[1][1]?>" min="<?php echo $the_big_array2[1][0]?>" type="range" value="<?php echo $data["value0"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][0]?></span> <span id="range0_value_text" style="margin-top: 7px"><?php echo $data["value0"]." Вольт"; ?></span> <span class="tick"><?php echo $the_big_array2[1][1]?></span>
							</div>
						</div>
					</div>
				</td>
				
					<td>
					<div class="range_contaner" >
						<div class="range" id="range0_handler"
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Cos ф:</p><input disabled id="0" max="1" min="0" type="range" value="1">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick">0</span> <span id="" style="margin-top: 7px">0.5</span> <span class="tick">1</span>
							</div>
						</div>
					</div>
				</td>
				
			</tr>
						<tr>
						<!-- ДАТЧИК 2 -->
				<td colspan="3">
					<p style="text-align: center; font-size:120%; font-weight: bold;">Датчик 2:</p>
				</td>
			</tr>
			
			<tr>
			
				
				<td>
					<div class="range_contaner" >
						<div class="range" id="range1_handler"
						<?php 
						if (/*$the_big_array2[1][2] > $data["value1"] || */$the_big_array2[1][3] < $data["value1"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Напряжение:</p><input disabled id="range1" max="<?php echo $the_big_array2[1][3]?>" min="<?php echo $the_big_array2[1][2]?>" type="range" value="<?php echo $data["value1"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][2]?></span> <span id="range1_value_text" style="margin-top: 7px"><?php echo $data["value1"]." кВт"; ?></span> <span class="tick"><?php echo $the_big_array2[1][3]?></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="range_contaner">
						<div class="range" id="range4_handler"
						<?php 
						if (/*$the_big_array2[1][8] > $data["value4"] || */$the_big_array2[1][9] < $data["value4"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Мощность:</p><input disabled id="range4" max="<?php echo $the_big_array2[1][9]?>" min="<?php echo $the_big_array2[1][8]?>" type="range" value="<?php echo $data["value4"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][8]?></span> <span id="range4_value_text" style="margin-top: 7px"><?php echo $data["value4"]." кВт"; ?></span> <span class="tick"><?php echo $the_big_array2[1][9]?></span>
							</div>
						</div>
					</div>
				</td>
				
					<td>
					<div class="range_contaner" >
						<div class="range" id="range0_handler"
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Cos ф:</p><input disabled id="0" max="1" min="0" type="range" value="1">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick">0</span> <span id="" style="margin-top: 7px">0.5</span> <span class="tick">1</span>
							</div>
						</div>
					</div>
				</td>
				
			</tr>
			<tr>
				<td colspan="3">
					<p style="text-align: center; font-size:120%; font-weight: bold;">Внутри помещения:</p>
				</td>
			</tr>
			<tr>
				<td>
					<div class="range_contaner">
						<div class="range" id="range6_handler"
						<?php 
						if ($the_big_array2[1][12] > $data["value6"] || $the_big_array2[1][13] < $data["value6"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Температура:</p><input disabled id="range6" max="<?php echo $the_big_array2[1][13]?>" min="<?php echo $the_big_array2[1][12]?>" type="range" value="<?php echo $data["value6"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][12]?></span> <span id="range6_value_text" style="margin-top: 7px"><?php echo $data["value6"]." °С"; ?></span> <span class="tick"><?php echo $the_big_array2[1][13]?></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="range_contaner">
						<div class="range" id="range7_handler"
						<?php 
						if ($the_big_array2[1][14] > $data["value7"] || $the_big_array2[1][15] < $data["value7"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Влажность:</p><input disabled id="range7" max="<?php echo $the_big_array2[1][15]?>" min="<?php echo $the_big_array2[1][14]?>" type="range" value="<?php echo $data["value7"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][14]?></span> <span id="range7_value_text" style="margin-top: 7px"><?php echo $data["value7"]." %"; ?></span> <span class="tick"><?php echo $the_big_array2[1][15]?></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="range_contaner">
						<div class="range" id="range8_handler"
						<?php 
						if ($the_big_array2[1][16] > $data["value8"] || $the_big_array2[1][17] < $data["value8"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Освещенность:</p><input disabled id="range8" max="<?php echo $the_big_array2[1][17]?>" min="<?php echo $the_big_array2[1][16]?>" type="range" value="<?php echo $data["value8"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][16]?></span> <span id="range8_value_text" style="margin-top: 7px"><?php echo $data["value8"]." lux"; ?></span> <span class="tick"><?php echo $the_big_array2[1][17]?></span>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p style="text-align: center; font-size:120%; font-weight: bold;">Снаружи помещения:</p>
				</td>
			</tr>
			<tr>
				<td>
					<div class="range_contaner">
						<div class="range" id="range9_handler"
						<?php 
						if ($the_big_array2[1][18] > $data["value9"] || $the_big_array2[1][19] < $data["value9"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Температура:</p><input disabled id="range9" max="<?php echo $the_big_array2[1][19]?>" min="<?php echo $the_big_array2[1][18]?>" type="range" value="<?php echo $data["value9"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][18]?></span> <span id="range9_value_text" style="margin-top: 7px"><?php echo $data["value9"]." °С"; ?></span> <span class="tick"><?php echo $the_big_array2[1][19]?></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="range_contaner">
						<div class="range" id="range10_handler"
						<?php 
						if ($the_big_array2[1][20] > $data["value10"] || $the_big_array2[1][21] < $data["value10"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Влажность:</p><input disabled id="range10" max="<?php echo $the_big_array2[1][21]?>" min="<?php echo $the_big_array2[1][20]?>" type="range" value="<?php echo $data["value10"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][20]?></span> <span id="range10_value_text" style="margin-top: 7px"><?php echo $data["value10"]." %"; ?></span> <span class="tick"><?php echo $the_big_array2[1][21]?></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="range_contaner">
						<div class="range" id="range11_handler"
						<?php 
						if ($the_big_array2[1][22] > $data["value11"] || $the_big_array2[1][23] < $data["value11"])
						{	
						echo 'style="background-color: #ffb2b6"';
						}
						?>
						>
							<p style="text-align: center; font-size:100%; font-weight: bold;">Освещенность:</p><input disabled id="range11" max="<?php echo $the_big_array2[1][23]?>" min="<?php echo $the_big_array2[1][22]?>" type="range" value="<?php echo $data["value11"]; ?>">
							<div class="ticks">
								<!-- You could generate the ticks based on your min, max & step values. -->
								<span class="tick"><?php echo $the_big_array2[1][22]?></span> <span id="range11_value_text" style="margin-top: 7px"><?php echo $data["value11"]." lux"; ?></span> <span class="tick"><?php echo $the_big_array2[1][23]?></span>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td width="25%">
					<div class="button_padding">
						<div class="button_class" id="switch_heating_button">
							Реле 1
							<div class="switch-red" id="led00" style="<?php if(1 == $the_big_array[1][12]){echo "visibility: hidden;";}?>"></div>
							<div class="switch-green" id="led01" style="<?php if(1 != $the_big_array[1][12]){echo "visibility: hidden;";}?>"></div>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class="button_padding">
						<div class="button_class" id="switch_light_button">
							Реле 2
							<div class="switch-red" id="led10" style="<?php if(1 == $the_big_array[1][13]){echo "visibility: hidden;";}?>"></div>
							<div class="switch-green" id="led11" style="<?php if(1 != $the_big_array[1][13]){echo "visibility: hidden;";}?>"></div>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class="button_padding">
						<div class="button_class" id="switch_ventilation_button">
							Реле 3
							<div class="switch-red" id="led20" style="<?php if(1 == $the_big_array[1][14]){echo "visibility: hidden;";}?>"></div>
							<div class="switch-green" id="led21" style="<?php if(1 != $the_big_array[1][14]){echo "visibility: hidden;";}?>"></div>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class="button_padding">
						<div class="button_class" id="switch_humidifier_button">
							Реле 4
							<div class="switch-red" id="led30" style="<?php if(1 == $the_big_array[1][15]){echo "visibility: hidden;";}?>"></div>
							<div class="switch-green" id="led31" style="<?php if(1 != $the_big_array[1][15]){echo "visibility: hidden;";}?>"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div id="footer_handler" style="padding: 20px;">
		<div id="footer" style="position: fixed; left: 0; bottom: 0; padding: 5px; background: black; color: white; width: 100%;">
			&copy; Цифровой прорыв &#8211; 2020. Разработано: mail@pmelikov.ru.
		</div>
	</div>
	<script type="text/javascript">

	                       var i;
	                       var my_array_index = 0;
	                       
	                           setInterval(function()
	                           {
	                               $.ajax({
	                               type:'POST',
	                               url:'./php/status.php',
	                               dataType: "json",
	                               data: '',
	                               success:function(data){
									   //ИНДИКАТОРЫ СОСТОЯНИЯ РЕЛЕ
	                                   if (data.status_of_heater)
	                                   {
	                                   led00.style.visibility = "hidden";
	                                   led01.style.visibility = "visible";
	                                   } 
	                                   else {
	                                   led01.style.visibility = "hidden";
	                                   led00.style.visibility = "visible";
	                                   }
	                                   
	                                   if (data.status_of_light)
	                                   {
	                                   led10.style.visibility = "hidden";
	                                   led11.style.visibility = "visible";
	                                   } 
	                                   else {
	                                   led11.style.visibility = "hidden";
	                                   led10.style.visibility = "visible";
	                                   }
	                                   
	                                   if (data.status_of_ventilation)
	                                   {
	                                   led20.style.visibility = "hidden";
	                                   led21.style.visibility = "visible";
	                                   } 
	                                   else {
	                                   led21.style.visibility = "hidden";
	                                   led20.style.visibility = "visible";
	                                   }
	                                   if (data.status_of_humidifier)
	                                   {
	                                   led30.style.visibility = "hidden";
	                                   led31.style.visibility = "visible";
	                                   } 
	                                   else {
	                                   led31.style.visibility = "hidden";
	                                   led30.style.visibility = "visible";
	                                   }
	                                   
										for (i = 7; i < 12; i++) {
	                                   document.getElementById("range"+i).value = data['value'+i];
	                                   //document.getElementById("range"+i+"_value_text").textContent= data['value'+i]+" ppm";
	                                   }
//ВЫВОД НАПРЯЖЕНИЯ И МОЩНОСТИ
 document.getElementById("range"+0).value = (data['value'+0]);
 document.getElementById("range"+1).value = (data['value'+1]);
 document.getElementById("range"+4).value = (data['value'+4]);
 document.getElementById("range"+5).value = (data['value'+5]);
	                                   

   document.getElementById("range0_value_text").textContent= data.value0+" кВт";
   document.getElementById("range1_value_text").textContent= data.value1+" Вольт"; 
   document.getElementById("range4_value_text").textContent= data.value4+" кВт";
   document.getElementById("range5_value_text").textContent= data.value5+" Вольт";
//ВЫВОД ДАННЫХ КЛИМАТА
	                                   document.getElementById("range7_value_text").textContent= data.value7+" %";
	                                   document.getElementById("range8_value_text").textContent= data.value8+" lux";
	                                   document.getElementById("range9_value_text").textContent= data.value9+" °С";
	                                   document.getElementById("range10_value_text").textContent= data.value10+" %";
	                                   document.getElementById("range11_value_text").textContent= data.value11+" lux";
	                                   
	                                   
										//ЕСЛИ ЗАЩКАЛ, ТО МЕНЯЕМ ЦВЕТ
										if ( (<?php echo $the_big_array2[1][0];?> > data.value0) || (data.value0 > <?php echo $the_big_array2[1][1];?>))
										{
										range0_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range0_handler.style.backgroundColor = "#F8F8F8";
										}	
										//ЕСЛИ ЗАЩКАЛ, ТО МЕНЯЕМ ЦВЕТ
										if ( (<?php echo $the_big_array2[1][2];?> > data.value1) || (data.value1 > <?php echo $the_big_array2[1][3];?>))
										{
										range1_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range1_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										//ЕСЛИ ЗАЩКАЛ, ТО МЕНЯЕМ ЦВЕТ										
																			
										if ( (<?php echo $the_big_array2[1][8];?> > data.value4) || (data.value4 > <?php echo $the_big_array2[1][9];?>))
										{
										range4_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range4_handler.style.backgroundColor = "#F8F8F8";
										}	
										//ЕСЛИ ЗАЩКАЛ, ТО МЕНЯЕМ ЦВЕТ
										if ( (<?php echo $the_big_array2[1][10];?> > data.value5) || (data.value5 > <?php echo $the_big_array2[1][11];?>))
										{
										range5_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range5_handler.style.backgroundColor = "#F8F8F8";
										}	
										//ЕСЛИ ЗАЩКАЛ, ТО МЕНЯЕМ ЦВЕТ
																				
										if ( (<?php echo $the_big_array2[1][14];?> > data.value7) || (data.value7 > <?php echo $the_big_array2[1][15];?>))
										{
										range7_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range7_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										if ( (<?php echo $the_big_array2[1][16];?> > data.value8) || (data.value8 > <?php echo $the_big_array2[1][17];?>))
										{
										range8_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range8_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										if ( (<?php echo $the_big_array2[1][18];?> > data.value9) || (data.value9 > <?php echo $the_big_array2[1][19];?>))
										{
										range9_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range9_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										if ( (<?php echo $the_big_array2[1][20];?> > data.value10) || (data.value10 > <?php echo $the_big_array2[1][21];?>))
										{
										range10_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range10_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										if ( (<?php echo $the_big_array2[1][22];?> > data.value11) || (data.value11 > <?php echo $the_big_array2[1][23];?>))
										{
										range11_handler.style.backgroundColor = "#ffb2b6";										
										}
										else
										{
										range11_handler.style.backgroundColor = "#F8F8F8";
										}	
										
										
	                                   }
	                               });
	                           
	                           }   
	                           , 400);
	                           
	                           //ОБРАБОТЧИК НАЖАТИЯ КНОПОК
	                       $(document).ready(function(){
	                       $("#switch_heating_button").click(function(){

	                           $.ajax({
	                               type: 'POST',
	                               url: './php/buttons.php',
	                       data: 'button_id_that_was_clicked=0',
	                        success: function(data){
	                        $('.results').html(data);
	                               }
	                           });
	                       });
	                       });
	                       
	                       $(document).ready(function(){
	                       $("#switch_light_button").click(function(){

	                           $.ajax({
	                               type: 'POST',
	                               url: './php/buttons.php',
	                               data: 'button_id_that_was_clicked=1',
	                                success: function(data){
	                                $('.results').html(data);
	                               }
	                           });
	                       });
	                       });
	                       
	                       $(document).ready(function(){
	                       $("#switch_ventilation_button").click(function(){

	                           $.ajax({
	                               type: 'POST',
	                               url: './php/buttons.php',
	                               data: 'button_id_that_was_clicked=2',
	                                success: function(data){
	                                $('.results').html(data);
	                               }
	                           });
	                       });
	                       });
	                       
	                       $(document).ready(function(){
	                       $("#switch_humidifier_button").click(function(){

	                           $.ajax({
	                               type: 'POST',
	                               url: './php/buttons.php',
	                               data: 'button_id_that_was_clicked=3',
	                                success: function(data){
	                                $('.results').html(data);
	                               }
	                           });
	                       });
	                       });
	           
	</script> 
</body>
</html>