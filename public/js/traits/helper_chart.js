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

var object_chart = new object_chart();