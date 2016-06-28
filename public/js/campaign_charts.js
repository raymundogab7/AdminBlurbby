jQuery(document).ready(function(){
    
    "use strict";

    function showTooltip(x, y, contents) {
	jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
	    position: 'absolute',
	    display: 'none',
	    top: y + 5,
	    left: x + 5
	}).appendTo("body").fadeIn(200);
    }
    
    /*****SIMPLE CHART*****/


    //var likes = [[0, 23], [1, 10], [2,13], [3, 22], [4, 29], [5, 34], [6, 56]];
	//var ticksq = [[0,'18-Apr-16'],[1,'19-Apr-16'],[2,'20-Apr-16'],[3,'21-Apr-16'],[4,'22-Apr-16'],[5,'23-Apr-16'],[6,'24-Apr-16']];
    var ticks = [];
	$.get('/campaign/getLastSevenDays/'+$("#campaign_id").val()+'/snapshot_likes', function(data){

    	var plot = jQuery.plot(jQuery("#basicflot"),
		[{
		    data: data.data,
		    label: "Likes",
		    color: "#4cae4c"
		}
		],
		{
		    series: {
			lines: {
			    show: false
			},
			splines: {
			    show: true,
			    tension: 0.4,
			    lineWidth: 1,
			    fill: 0.4
			},
			shadowSize: 0
		    },
		    points: {
			show: true,
		    },
		    legend: {
			container: '#basicFlotLegend',
	                noColumns: 0
		    },
		    grid: {
			hoverable: true,
			clickable: true,
			borderColor: '#ddd',
			borderWidth: 0,
			labelMargin: 5,
			backgroundColor: '#fff'
		    },
		    yaxis: {
			color: '#eee'
		    },
		    xaxis: {
			color: '#eee',
			ticks: data.ticks
		    }
		});
			
		var previousPoint = null;
		jQuery("#basicflot").bind("plothover", function (event, pos, item) {
		jQuery("#x").text(pos.x.toFixed(0));
		jQuery("#y").text(pos.y.toFixed(0));
				
		if(item) {
		    if (previousPoint != item.dataIndex) {
			previousPoint = item.dataIndex;
							
			jQuery("#tooltip").remove();
			var x = item.datapoint[0].toFixed(0),
			y = item.datapoint[1].toFixed(0);
		 			
			showTooltip(item.pageX, item.pageY,
			y + " likes");
		    }
				
		} else {
		    jQuery("#tooltip").remove();
		    previousPoint = null;            
		}
			
	    });
			
	    jQuery("#basicflot").bind("plotclick", function (event, pos, item) {
		if (item) {
		    plot.highlight(item.series, item.datapoint);
		}
	    });
    });

    
    
    
    /*****CHART 2 *****/
    
    //var views = [[0, 4], [1, 7], [2,12], [3, 15], [4, 19], [5, 21], [6, 30]];
	$.get('/campaign/getLastSevenDays/'+$("#campaign_id").val()+'/snapshot_uviews', function(data){
	    var plot = jQuery.plot(jQuery("#basicflot2"),
		[{
		    data: data.data,
		    label: "View",
		    color: "#428bca"
		}
		],
		{
		    series: {
			lines: {
			    show: false
			},
			splines: {
			    show: true,
			    tension: 0.4,
			    lineWidth: 1,
			    fill: 0.5
			},
			shadowSize: 0
		    },
		    points: {
			show: true
		    },
		    legend: {
			container: '#basicFlotLegend2',
	                noColumns: 0
		    },
		    grid: {
			hoverable: true,
			clickable: true,
			borderColor: '#ddd',
			borderWidth: 0,
			labelMargin: 5,
			backgroundColor: '#fff'
		    },
		    yaxis: {
			color: '#eee'
		    },
		    xaxis: {
			color: '#eee',
			ticks: data.ticks
		    }
		});
			
		var previousPoint = null;
		jQuery("#basicflot2").bind("plothover", function (event, pos, item) {
		jQuery("#x").text(pos.x.toFixed(0));
		jQuery("#y").text(pos.y.toFixed(0));
				
		if(item) {
		    if (previousPoint != item.dataIndex) {
			previousPoint = item.dataIndex;
							
			jQuery("#tooltip").remove();
			var x = item.datapoint[0].toFixed(0),
			y = item.datapoint[1].toFixed(0);
		 			
			showTooltip(item.pageX, item.pageY,
			y + " views");
		    }
				
		} else {
		    jQuery("#tooltip").remove();
		    previousPoint = null;            
		}
			
	    });
			
	    jQuery("#basicflot2").bind("plotclick", function (event, pos, item) {
		if (item) {
		    plot.highlight(item.series, item.datapoint);
		}
	    });
    });
    
    /*****CHART 3 *****/
    
    //var usage = [[0, 4], [1, 5], [2,2], [3, 7], [4, 4], [5, 9], [6, 20]];
	$.get('/campaign/getLastSevenDays/'+$("#campaign_id").val()+'/snapshot_usage', function(data){
	    var plot = jQuery.plot(jQuery("#basicflot3"),
		[{
		    data: data.data,
		    label: "Usage",
		    color: "#eea236"
		}
		],
		{
		    series: {
			lines: {
			    show: false
			},
			splines: {
			    show: true,
			    tension: 0.4,
			    lineWidth: 1,
			    fill: 0.4
			},
			shadowSize: 0
		    },
		    points: {
			show: true
		    },
		    legend: {
			container: '#basicFlotLegend3',
	                noColumns: 0
		    },
		    grid: {
			hoverable: true,
			clickable: true,
			borderColor: '#ddd',
			borderWidth: 0,
			labelMargin: 5,
			backgroundColor: '#fff'
		    },
		    yaxis: {
			color: '#eee'
		    },
		    xaxis: {
			color: '#eee',
			ticks: data.ticks
		    }
		});
			
		var previousPoint = null;
		jQuery("#basicflot3").bind("plothover", function (event, pos, item) {
		jQuery("#x").text(pos.x.toFixed(0));
		jQuery("#y").text(pos.y.toFixed(0));
				
		if(item) {
		    if (previousPoint != item.dataIndex) {
			previousPoint = item.dataIndex;
							
			jQuery("#tooltip").remove();
			var x = item.datapoint[0].toFixed(0),
			y = item.datapoint[1].toFixed(0);
		 			
			showTooltip(item.pageX, item.pageY,
			"Used " + y + " times");
		    }
				
		} else {
		    jQuery("#tooltip").remove();
		    previousPoint = null;            
		}
			
	    });
			
	    jQuery("#basicflot3").bind("plotclick", function (event, pos, item) {
		if (item) {
		    plot.highlight(item.series, item.datapoint);
		}
	    });
    });
});