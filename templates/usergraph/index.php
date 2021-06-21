<?php
 
$dataPoints1 = array();
$updateInterval = 2000; //in millisecond
$initialNumberOfDataPoints = 700;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
$y1 = 150;
// generates first set of dataPoints 
for($i = 0; $i < $initialNumberOfDataPoints; $i++){
	$y1 += round(rand(-2, 2));
	// array_push($dataPoints1, array("x" => 0, "y" => 0));
	$x += $updateInterval;
}
 
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<div id="chartContainer" style="height: 370px; width: 100%; margin-top:100px;"></div>

<div id="ranNumber"><?php //echo $temperature; ?>
<h1><?php //echo $time; ?></h1>
<input type="hidden" id="getTemperature" value="<?php echo $temperature; ?>" />
<input type="hidden" id="getTime" value="<?php echo $time; ?>" />
</div>
<script>
window.onload = function() {
 
var updateInterval = <?php echo $updateInterval ?>;
var dataPoints1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
var yValue1 = <?php echo $y1 ?>;
var xValue = <?php echo $x ?>;
 
var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: "ROOM TEMPERATURE"
	},
	axisX: {
		title: "Time"
	},
	axisY:{
        title: "Degree",
		suffix: "°"
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
			type: "line",
			name: "Room A",
			xValueType: "dateTime",
			yValueFormatString: "#,### °C",
			xValueFormatString: "hh:mm:ss TT",
			showInLegend: true,
			legendText: "{name} " + yValue1 + " watts",
			dataPoints: dataPoints1
		}]
});
 
chart.render();
setInterval(function(){ dataLoaded(); updateChart();}, updateInterval);
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

function dataLoaded(){
    // e.preventDefault();
    var nValue1 = Math.floor((Math.random() * 10) + 1);
	// alert(nValue1);
    $.ajax({
            method: 'get',
            data: {
                role: nValue1
            },
            url: "<?php echo $this->Url->build(['controller' => 'Usergraph', 'action' => 'edit']); ?>",
            success: function(response) {
                $('#ranNumber').html(response);
            }
			
    });
  }
 
function updateChart() {
	var deltaY1, deltaY2;
	xValue += updateInterval;
	// adding random value
	gg = $("#getTemperature").val();
	// yValue1 = gg;
	yValue1 =  Math.round(2 + Math.random() *(-2-2));
	console.log(gg);
    if(dataPoints1.length > 700){
        dataPoints1.shift();
    }
	// pushing the new values
	dataPoints1.push({
		x: xValue,
		y: yValue1
	});
 
	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = "Room A " + yValue1 + "°C";
	chart.render();
}
 
}
</script>          