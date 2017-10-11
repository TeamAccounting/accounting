
function initChart(){

	
		$.get("php/initchart.php",{request:'initchart',type:"expense"},function(data){
			//console.log(data); DEBUG
			var series=[];
			$.each(data,function(key, val){
				var subseries = {};
					subseries.label = key;
					subseries.data = val;
					series.push(subseries);   	
			});
			//sconsole.log(series); DEBUG
			$.plot("#linegraph1",series,{
				series:{
					bars:{
						show:true, barWidth:0.15,order:1
					}
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
		},'json');
		
		
			$.get("php/initchart.php",{request:'initchart',type:"income"},function(data){
			//console.log(data);DEBUG
			var series=[];
			$.each(data,function(key, val){
				var subseries = {};
					subseries.label = key;
					subseries.data = val;
					series.push(subseries);   	
			});
			//console.log(series); DEBUG
			$.plot("#linegraph2",series,{
				series:{
					
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
		},'json');
				
				
		
		$.get("php/initchart.php",{request:'initchart',type:"net"},function(data){
			//console.log(data); DEBUG
			var series=[];
			$.each(data,function(key, val){
					var subseries = {};
					subseries.label = key;
					subseries.data = val;
					if(key!="Net Income"){
					
						subseries.bars = { show:true, barWidth:0.15,order:1};
						
					}else{
						subseries.lines = { show:true };
						subseries.points = { show:true };
					}
					series.push(subseries);
					//console.log(key);
			});
		
			//console.log(series); DEBUG
			$.plot("#linegraph", series,{
				series:{
					
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
		
		},'json');
				
};


function makeChart(ids,types){
	
		var delay=1000; //1 second
		var id = '#';
		id = id.concat(ids);
		console.log(ids);
	if(types=='expense'){
	console.log(id);

	$.get("php/initchart.php",{request:'initchart',type:'expense'},function(data){
			console.log(data);
			var series=[];
			$.each(data,function(key, val){
				var subseries = {};
					subseries.label = key;
					subseries.data = val;
					series.push(subseries);   	
			});
			console.log(series);
		
			
				$.plot(id,series,{
				series:{
					bars:{
						show:true, barWidth:0.15,order:1
					}
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
				

		},'json');
		}
		
		if(types=='income'){
			$.get("php/initchart.php",{request:'initchart',type:"income"},function(data){
			console.log(data);
			var series=[];
			$.each(data,function(key, val){
				var subseries = {};
					subseries.label = key;
					subseries.data = val;
					series.push(subseries);   	
			});
			console.log(series);
			$.plot(id,series,{
				series:{
					
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
		},'json');
				
			
		};
		
		if(types=='net'){
			$.get("php/initchart.php",{request:'initchart',type:"net"},function(data){
			//console.log(data); DEBUG
			var series=[];
			$.each(data,function(key, val){
					var subseries = {};
					subseries.label = key;
					subseries.data = val;
					if(key!="Net Income"){
					
						subseries.bars = { show:true, barWidth:0.15,order:1};
						
					}else{
						subseries.lines = { show:true };
						subseries.points = { show:true };
					}
					
					
					series.push(subseries);
					//console.log(key);
			});
		
			//console.log(series); DEBUG
			$.plot(id, series,{
				series:{
					
				},
				xaxis:{mode:"category",ticks:[
					[0, "January"],
					[1, "February"],
					[2, "March"],
					[3, "April"],
					[4, "May"],
					[5, "June"],
					[6, "July"],
					[7, "August"],
					[8, "September"],
					[9, "October"],
					[10, "November"],
					[11, "December"],
				], tickLength:1}});
		
		},'json');
		
		};
	
}

			
