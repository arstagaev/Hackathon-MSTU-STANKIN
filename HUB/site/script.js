var min_lpg_random = 0;
var max_lpg_random = 10000;
var min_lpg = 200;
var max_lpg = 5000;
var timerId = setInterval(function() {
  gas1_current =  Math.floor(Math.random() * (max_lpg_random - min_lpg_random + 1) ) + min_lpg_random;
  document.getElementById("range1").value = gas1_current;
  document.getElementById("gas1_current").textContent= gas1_current+" ppm";
  if (gas1_current<min_lpg) {
  document.getElementById('gas1_current').style.color = 'red';
}
else {
  if (gas1_current>max_lpg) {
  document.getElementById('gas1_current').style.color = 'red';
}
else {
 document.getElementById('gas1_current').style.color = 'black';
}
}
}, 1000);