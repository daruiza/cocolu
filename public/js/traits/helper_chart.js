function object_chart() {	

}

object_chart.prototype.onjquery = function() {	
};

object_chart.prototype.paint_chart = function(container,type,label,labels,data,backgroundColor,borderColor) {
	var ctx = $('#'+container);
	var myChart = new Chart(ctx, {
	    type: type,
	    data: {
	        labels: labels,
	        datasets: [{
	            label: label,
	            data: data,
	            backgroundColor: backgroundColor,
	            borderColor: borderColor,
	            borderWidth: 1
	        }]
	    },
	    options: {
	       
	    }
	});

};

object_chart.prototype.paint_chart_bar = function(container,type,label,labels,data,backgroundColor,borderColor) {
	var ctx = $('#'+container);
	var myChart = new Chart(ctx, {
	     type: type,
		    data: {
		      labels: labels,
		      datasets: [
		        {		        			        	
		        	data: data,
		        	backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)',
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)',
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
	            	borderWidth: 1
		        }
		      ]
		    },
		    options: {
		      legend: { display: false },
		      title: {
		        display: true,
		        text: label
		      },
		      scales: {
		            yAxes: [{
		            	barPercentage: 0.7,
		                ticks: {
		                    beginAtZero: true
		                }
		            }],
		            xAxes: [{
			            barPercentage: 0.7,
			            ticks: {
		                    beginAtZero: true,
		                }
			        }]
		        }
		    }
	});

};

var object_chart = new object_chart();