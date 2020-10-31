<!DOCTYPE html>
<html lang="ru">
<head>
	<link href="./img/stankin_logo.png" rel="icon" type="image/x-icon">
	<link href="./css/statistics.css" rel="stylesheet">
	<title>Цифровой прорыв-2020</title>
	<meta charset="utf-8">
		<script src="/node_modules/jquery/dist/jquery.min.js"></script>
		<!--
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.6.6/chartjs-plugin-zoom.min.js"></script>
	<script src="https://github.com/nagix/chartjs-plugin-streaming/releases/download/v1.7.1/chartjs-plugin-streaming.min.js"></script>
	-->
	
	<script src="/js/moment.min.js"></script>
	<script src="/js/Chart.min.js"></script>
	<script src="/js/hammer.min.js"></script>
	<script src="/js/chartjs-plugin-zoom.min.js"></script>
	<script src="/js/chartjs-plugin-streaming.min.js"></script>
	
	
<?php
//чтение текущих настроек
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
  while (($data2 = fgetcsv($h, 1000, ",")) !== FALSE) 
  {
    $the_big_array2[] = $data2;		
  }
  fclose($h);
}


?>	
	
	
	<script>
//настройка цветов графика
	var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

var values_from_sensor=[];

function randomScalingFactor() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}
//var i = 1;

//функции, вызываемые при добавлении данных в графики
function onRefresh0(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[0]
		});
	});
}

function onRefresh1(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
		y: values_from_sensor[1]
		});
	});
}

function onRefresh2(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[2]
		});
	});
}

function onRefresh3(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[3]
		});
	});
}

function onRefresh4(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[4]
		});
	});
}

function onRefresh5(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[5]
		});
	});
}

function onRefresh6(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[6]
		});
	});
}

function onRefresh7(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[7]
		});
	});
}

function onRefresh8(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[8]
		});
	});
}

function onRefresh9(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[9]
		});
	});
}

function onRefresh10(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[10]
		});
	});
}

function onRefresh11(chart) {
	chart.config.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: Date.now(),
			//y: randomScalingFactor()
			y: values_from_sensor[11]
		});
	});
}
var color = Chart.helpers.color;


//конфигурации графиков

var config0 = {
	type: 'line',
	data: {
		datasets: [ {
			label: "Мощность:",
			backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Мощность:'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh0
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'кВт'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			//displayColors : false,
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][1]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][0]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 20000
			},
			rangeMin: {
				x: 1000
			}
		}
	}
};
var config1 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Напряжение:',
			backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
			borderColor: chartColors.red,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Напряжение:'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh1
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Вольт'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][3]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][2]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config4 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Мощность:',
			backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Мощность:'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh4
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'кВт'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][9]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][8]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config5 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Напряжение:',
			backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
			borderColor: chartColors.red,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Напряжение:'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh5
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Вольт'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][11]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][10]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config6 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Температура',
			backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
			borderColor: chartColors.green,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Температура'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh6
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: '°С'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][13]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][12]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config7 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Влажность',
			backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Влажность'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh7
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: '%'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][15]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][14]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config8 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Освещенность',
			backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
			borderColor: chartColors.red,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Освещенность'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh8
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'lux'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][17]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][16]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config9 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Температура',
			backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
			borderColor: chartColors.green,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Температура'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh9
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: '°С'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][19]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][18]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config10 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Влажность',
			backgroundColor: color(chartColors.yellow).alpha(0.5).rgbString(),
			borderColor: chartColors.yellow,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Влажность'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh10
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: '%'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][21]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][20]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

var config11 = {
	type: 'line',
	data: {
		datasets: [ {
			label: 'Освещенность',
			backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: false,
			text: 'Освещенность'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					refresh: 500,
					delay: 1000,
					onRefresh: onRefresh11
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'lux'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		},
		pan: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: <?php echo $the_big_array2[1][23]?>
			},
			rangeMin: {
				x: <?php echo $the_big_array2[1][22]?>
			}
		},
		zoom: {
			enabled: true,
			mode: 'x',
			rangeMax: {
				x: 60000
			},
			rangeMin: {
				x: 500
			}
		}
	}
};

window.onload = function() {
	//создание графиков при загрузке страницы
	var ctx = document.getElementById('myChart0').getContext('2d');
	window.myChart = new Chart(ctx, config0);
	
	var ctx = document.getElementById('myChart1').getContext('2d');
	window.myChart = new Chart(ctx, config1);
	
	var ctx = document.getElementById('myChart4').getContext('2d');
	window.myChart = new Chart(ctx, config4);
	
	var ctx = document.getElementById('myChart5').getContext('2d');
	window.myChart = new Chart(ctx, config5);
	
	var ctx = document.getElementById('myChart6').getContext('2d');
	window.myChart = new Chart(ctx, config6);
	
	var ctx = document.getElementById('myChart7').getContext('2d');
	window.myChart = new Chart(ctx, config7);
	
	var ctx = document.getElementById('myChart8').getContext('2d');
	window.myChart = new Chart(ctx, config8);
	
	var ctx = document.getElementById('myChart9').getContext('2d');
	window.myChart = new Chart(ctx, config9);
	
	var ctx = document.getElementById('myChart10').getContext('2d');
	window.myChart = new Chart(ctx, config10);
	
	var ctx = document.getElementById('myChart11').getContext('2d');
	window.myChart = new Chart(ctx, config11);
};



 //var values_from_sensor[];
 var i;
 
// values_from_sensor[0]=123;
 
setInterval(function()
	                           {
	                               $.ajax({
	                               type:'POST',
	                               url:'./php/status.php',
	                               dataType: "json",
	                               data: '',
	                               success:function(data){
	                                   
	                                   for (i = 0; i < 12; i++) {
	                                   values_from_sensor[i]= data['value'+i];
	                                   //document.getElementById("range"+i+"_value_text").textContent= data['value'+i]+" ppm";
	                                   }
	                                   										
	                                   }
	                               });
	                           
	                           }   
	                           , 400);
	</script>

</head>
<body style="max-width: 99%">

	<table width="100%">
		<tr>
			<td style="text-align: center; width="><img height="15%" src="./img/hack_logo.jpg"></td>
			<td style="text-align: center; width=">
				<p style="font-size:160%; font-weight: bold;"><nobr>Мониторинг и диспетчеризация</nobr></p>
				<p style="font-size:120%; font-weight: bold;"><nobr>потребления электроэнергии</nobr></p>
			</td>
		</tr>
	</table>
	<!-- меню -->
	<div class="top-menu-handler" style="text-align: center;">
		<div class="top-menu">
			<ul>
				<li>
					<a href="/index_hack.php">Терминал</a>
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
	<!-- меню -->
	
	<!--графики-->
	<div id="content" style="padding-left: 10px; padding-right: 0;">
		<p style="text-align: center; font-size:120%; font-weight: bold;">Датчик 1:</p>
		<canvas height="25%" width="100%" id="myChart5"></canvas>
		<canvas height="25%" width="100%" id="myChart0"></canvas>
		<p style="text-align: center; font-size:120%; font-weight: bold;">Датчик 2:</p>
		<canvas height="25%" width="100%" id="myChart1"></canvas>
		<canvas height="25%" width="100%" id="myChart4"></canvas>
				
		
		<p style="text-align: center; font-size:120%; font-weight: bold;">Внутри помещения:</p>
		<canvas height="25%" width="100%" id="myChart6"></canvas>
		<canvas height="25%" width="100%" id="myChart7"></canvas>
		<canvas height="25%" width="100%" id="myChart8"></canvas>
		<p style="text-align: center; font-size:120%; font-weight: bold;">Снаружи помещения:</p>
		<canvas height="25%" width="100%" id="myChart9"></canvas>
		<canvas height="25%" width="100%" id="myChart10"></canvas>
		<canvas height="25%" width="100%" id="myChart11"></canvas>
		
	</div>
	<!--графики-->
	
	<!--футер-->
	<div id="footer_handler" style="padding: 20px;">
		<div id="footer" style="position: fixed; left: 0; bottom: 0; padding: 5px; background: black; color: white; width: 100%;">
			&copy; Цифровой прорыв &#8211; 2020. Разработано: mail@pmelikov.ru.
		</div>
	</div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>