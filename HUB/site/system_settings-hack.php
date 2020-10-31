<!DOCTYPE html> 
<html lang="ru"> 
<link rel="icon" href="./img/stankin_logo.png" 
type="image/x-icon">
<link href="./css/system_settings.css" rel="stylesheet">

<title>Цифровой прорыв-2020</title> 

<head>
  <meta charset="utf-8" />
 
 </head>
 
 <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  
 <body>
 
 <!--меню-->
<table width="100%">
  <tr>
    <td  style="text-align: center; width="40%";"><img height="15%" src="./img/hack_logo.jpg"></td>
 <td  style="text-align: center; width="60%";">
<p style="font-size:160%; font-weight: bold;"><nobr>
Мониторинг и диспетчеризация</nobr></p>
<p style="font-size:120%; font-weight: bold;"><nobr>потребления электроэнергии</nobr></p>
</td>
  </tr>
</table>

<div class="top-menu-handler" style="text-align: center;">
<div class="top-menu" >
    <ul>
        <li ><a href="index_hack.php">Терминал</a></li>
		<li>
			<a href="statistics-hack.php">Статистика</a>
		</li>
        <li>
            <a href="system_settings-hack.php">Настройки</a>
            <!--<ul>
                <li><a href="access_settings.php">Доступ</a></li>
                <li><a href="system_settings.php">Система</a></li>
            </ul>-->
        </li>
        <li><a href="about_system-hack.html">О системе</a></li>
    </ul>
</div>
</div>

 <!--меню-->

<div id="content">

<div id="settings_table1" style="padding: 5px;">

 <?php //загрузка текущих настроек

$filename = './csv/settings.csv';

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

	for ($i = 0; $i <= 25; $i++) 
	{
	$data[0]["input".$i]=$the_big_array[1][$i];
	}
	
	for ($i = 0; $i <= 8; $i++) 
	{
	if($the_big_array[2][$i]){$data[1][$i] = 'checked';} else{$data[1][$i] = NULL;}
	}
//    echo json_encode($data);
echo $data[0][1];
?> 


 <!--таблица с настройками-->
<table id="settings_table" class="settings_table" border="1px" width="100%" >
<tr>
	<td class="other_td" colspan="5" style="text-align: center; font-size:120%; font-weight: bold;">Настройка датчиков электроэнергии:</td>
</tr>

<tr>
	<td class="column1">Параметр</td>
	<td class="column2">Размерн.</td>
	<td class="column3">Мин.</td>
	<td class="column4">Макс.</td>
	<td class="column5">Авто</td>
</tr>

<tr>
	 <td class="column1">Напряжение датчик 1</td>
	 <td class="column2">Вольт</td>
	 <td class="column3"><input type="text"  size = '3' maxlength="5" id="input10"  placeholder="<?php echo $data[0][input10]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input11"  placeholder="<?php echo $data[0][input11]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked5"  <?php echo $data[1][5]; ?>></td>
</tr>

<tr>
	 <td class="column1">Мощность датчик 1</td>
	 <td class="column2">кВт</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input0"  placeholder="<?php echo $data[0][input0]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input1"  placeholder="<?php echo $data[0][input1]; ?>"></td>
	<td class="column5"><input type="checkbox" id="checked0"  <?php echo $data[1][0]; ?>></td>
</tr>

<tr>
	 <td class="column1">Напряжение датчик 2</td>
	 <td class="column2">Вольт</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input2"  placeholder="<?php echo $data[0][input2]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input3"  placeholder="<?php echo $data[0][input3]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked1"  <?php echo $data[1][1]; ?>></td>
</tr>

<tr>
	 <td class="column1">Мощность датчик 2</td>
	 <td class="column2">кВт</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input8"  placeholder="<?php echo $data[0][input8]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input9"  placeholder="<?php echo $data[0][input9]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked4"  <?php echo $data[1][4]; ?>></td>
</tr>


<tr>
	<td class="other_td" colspan="5" style="text-align: center; font-size:120%; font-weight: bold;">Внутри помещения:</td>
</tr>

<tr>
	 <td class="column1">Температура</td>
	 <td class="column2">&degС</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input12"  placeholder="<?php echo $data[0][input12]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input13"  placeholder="<?php echo $data[0][input13]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked6"  <?php echo $data[1][6]; ?>></td>
</tr>

<tr>
	 <td class="column1">Влажность</td>
	 <td class="column2">%</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input14"  placeholder="<?php echo $data[0][input14]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input15"  placeholder="<?php echo $data[0][input15]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked7"  <?php echo $data[1][7]; ?>></td>
</tr>

<tr>
	 <td class="column1">Освещенность</td>
	 <td class="column2">lux</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input16"  placeholder="<?php echo $data[0][input16]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input17"  placeholder="<?php echo $data[0][input17]; ?>"></td>
	  <td class="column5"><input type="checkbox" id="checked8"  <?php echo $data[1][8]; ?>></td>
</tr>

<tr>
	<td class="other_td" colspan="5" style="text-align: center; font-size:120%; font-weight: bold;">Снаружи помещения:</td>
</tr>

<tr>
	 <td class="column1">Температура</td>
	 <td class="column2">&degС</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input18"  placeholder="<?php echo $data[0][input18]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input19"  placeholder="<?php echo $data[0][input19]; ?>"></td>
	  <td class="column5">Нет</td>
</tr>

<tr>
	 <td class="column1">Влажность</td>
	 <td class="column2">%</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input20"  placeholder="<?php echo $data[0][input20]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input21"  placeholder="<?php echo $data[0][input21]; ?>"></td>
	  <td class="column5">Нет</td>
</tr>

<tr>
	 <td class="column1">Освещенность</td>
	 <td class="column2">lux</td>
	  <td class="column3"><input type="text"  size = '3' maxlength="5" id="input22"  placeholder="<?php echo $data[0][input22]; ?>"></td>
	  <td class="column4"><input type="text"  size = '3' maxlength="5" id="input23"  placeholder="<?php echo $data[0][input23]; ?>"></td>
	  <td class="column5">Нет</td>
</tr>

<tr>
	<td class="other_td" colspan="5" style="text-align: center; font-size:120%; font-weight: bold;">Настройки доступа:</td>
</tr>

<tr>
	 <td class="other_td" colspan="2">Логин</td>
	 <td class="other_td" colspan="3"><input type="text"  size = '16' maxlength="10" id="input24"  placeholder="<?php echo $data[0][input24]; ?>"></td>
</tr>

<tr>
	 <td class="other_td" colspan="2">Пароль</td>
	 <td class="other_td" colspan="3"><input type="text"  size = '16' maxlength="10" id="input25"  placeholder="<?php echo $data[0][input25]; ?>"></td>
</tr>

<tr>
<td colspan="5"><input type="submit" id="save_settings_button" style="width: 100%; height: 50px; font-size:120%; font-weight: bold;" value="Сохранить"></td>
</tr>
<tr>

<script type="text/javascript">
//код для сохранения или сброса настроек
					function reset_settings() {
					if (confirm("Вы уверены, что хотите сбросить настройки?")) 
					{
					$.ajax({
                    type: 'POST',
                    url: '/php/settings_reset.php',
					data: {},
					success: function(data){
										
					//alert("Настройки сброшены.");
					location.reload(); //перезагрузить страницу
                                }
                        });
					}
					 
					
					else 
					{
					alert("Настройки не были сброшены.");
					}
	
					}

					var array_checked = [];
					var array_input = [];
					
					$(document).ready(function(){
					$("#save_settings_button").click(function(){

					
					if(document.getElementById("checked"+0).checked) {array_checked[0] = "1";} else {array_checked[0] = "0";} 
					if(document.getElementById("checked"+1).checked) {array_checked[1] = "1";} else {array_checked[1] = "0";} 
					for (i = 4; i <= 8; i++)
					{
					if(document.getElementById("checked"+i).checked) {array_checked[i] = "1";} else {array_checked[i] = "0";} 
					}


					
					
					
					
					for (i = 0; i < 4; i++) 
					{
	                array_input[i] = document.getElementById("input"+i).value;
					
					if(document.getElementById("input"+i).value == "")
					{
					array_input[i] = document.getElementById("input"+i).placeholder;
					}
					else
					{
					array_input[i] = document.getElementById("input"+i).value;	
					}						
					}
					
				
					for (i = 8; i <= 25; i++) 
					{
	                array_input[i] = document.getElementById("input"+i).value;
					
					if(document.getElementById("input"+i).value == "")
					{
					array_input[i] = document.getElementById("input"+i).placeholder;
					}
					else
					{
					array_input[i] = document.getElementById("input"+i).value;	
					}						
					}
					
					var json_array_checked = JSON.stringify(array_checked);
					var json_array_input = JSON.stringify(array_input);
					
					$.ajax({
                                type: 'POST',
                                url: '/php/settings.php',
					data: { json_array_checked: json_array_checked,
					json_array_input:json_array_input
					},
					success: function(data){
					$('.results').html(data);
					location.reload(); //перезагрузить страницу
                                }
                        });
						});
					});
					</script>

</table>
<a onClick="reset_settings();" style="cursor: pointer; cursor: hand;"><center><u>сброс настроек</a>
 </div>

 </div>
 
 <div id="footer_handler" style="padding: 20px;">
<div id="footer" style="position: fixed; left: 0; bottom: 0; padding: 5px; background: black; color: white; width: 100%;">&copy; Цифровой прорыв &#8211; 2020. Разработано: mail@pmelikov.ru.</div>
</div>

 </body>
</html>