$(document).ready(function () {
		$('#alcohol-gauge').jqxGauge({
				ranges: [{ startValue: 0, endValue: 0.02, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
								 { startValue: 0.02, endValue: 0.05, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
								 { startValue: 0.05, endValue: 0.08, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
								 { startValue: 0.08, endValue: 0.12, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 },
							 	 { startValue: 0.12, endValue: 0.125, style: { fill: '#9c1619', stroke: '#9c1619' }, endWidth: 20, startWidth: 16 }],
				ticksMinor: { interval: 0.005, size: '5%' },
				ticksMajor: { interval: 0.010, size: '12%' },
				width: '300px',
				height: '300px',
				radius: '150px',
				value: 0,
				colorScheme: 'scheme05',
				animationDuration: 2000,
				min: 0,
				max: 0.125,
				labels: { distance: '45%', position: 'none', interval: 0.02, offset: [0, -10], visible: true, formatValue: function (value) { return value; }}
		});

		$('#alcohol-gauge').jqxGauge('value', 0);
});

function updateAlcoholLevel() {
	var level = measureAlcoholLevel();
	setTimeout(setAlcoholLevel, 1000, level);
}

function measureAlcoholLevel() {
	$('#alcohol-level').text("A medir...");
	$("#alcohol-gauge").jqxGauge('val', 0);
	return Number(Number(Math.random()*0.15).toFixed(3));
}

function setAlcoholLevel(level) {
	$("#alcohol-gauge").jqxGauge('val', level);
	$('#alcohol-level').text(String(level) + "%");

	if (level < 0.02){
		$('#alcohol-level-description').text("Encontra-se apto para conduzir!");
	} else if (level < 0.05) {
		$('#alcohol-level-description').text("Excede o limite legal para contraordenação, caso tenha carta há menos de três anos! (0.02)");
	} else if (level < 0.08) {
		$('#alcohol-level-description').text("Excede o limite legal para contraordenação! (0.05)");
	} else if (level < 0.12) {
		$('#alcohol-level-description').text("Excede o limite legal para contraordenação muito grave! (0.08)");
	} else {
		$('#alcohol-level-description').text("Excede o limite legal para crime! (0.12)");
	}
}
