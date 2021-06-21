<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
</head>
<body>
<canvas id="canvas" height="450" width="600" style="margin-top: 100px;"></canvas>


<script>
let labels = [];
let data1 = [];
let data2 = [];
for (let i = 0; i < 100; i++) {
  labels.push("l" + i);
  data1.push(Math.floor(Math.random() * 100));
  data2.push(Math.floor(Math.random() * 100));
}
var ctx = document.getElementById('canvas').getContext('2d');
var chart = new Chart(ctx, {
  // The type of chart we want to create
  type: 'line',

  // The data for our dataset
  data: {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      fill: false,
      //backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: data1
    }]
  },

  // Configuration options go here
  options: {
    animation: {
      duration: 0 // general animation time
    },
    hover: {
      animationDuration: 0 // duration of animations when hovering an item
    },
    responsiveAnimationDuration: 0, // animation duration after a resize
    elements: {
      line: {
        tension: 0 // disables bezier curves
      }
    }
  }
});
</script>
</body>
</html>