<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1.0.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.9.0"></script>
</head>
<body>
<canvas id="myChart" style="margin-top:100px;height:500px;width:100%"></canvas>
<h1 id="ranNumber"><?php //echo $temperature; ?></h1>
<input type="hidden" id="getTemperature" value="<?php echo $temperature; ?>" />
<input type="hidden" id="getTime" value="<?php echo $time; ?>" />
    <script>


var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

function randomScalingFactor() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}

function onRefresh(chart) {
	var now = Date.now();
	chart.data.datasets.forEach(function(dataset) {
		dataset.data.push({
			x: now,
			y: randomScalingFactor()
		});
	});
}

var config = {
	type: 'line',
	data: {
		datasets: [{
			label: 'Dataset 2 (cubic interpolation)',
			backgroundColor: chartColors.blue,
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: true,
			text: 'Data labels plugin sample'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 900000,
					refresh: 10000,
					delay: 10000,
					onRefresh: onRefresh
				}
			}],
			yAxes: [{
				type: 'linear',
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'value'
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
		plugins: {
			datalabels: {
				backgroundColor: function(context) {
					return context.dataset.backgroundColor;
				},
				borderRadius: 4,
				clip: true,
				color: 'white',
				font: {
					weight: 'bold'
				},
				formatter: function(value) {
					return value.y;
				}
			}
		}
	}
};

window.onload = function() {
	var ctx = document.getElementById('myChart').getContext('2d');
	window.myChart = new Chart(ctx, config);
};





    </script>
</body>
</html>







