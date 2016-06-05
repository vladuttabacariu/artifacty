var map;
function setMarkers(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {	
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	console.log(xhttp.responseText);
		var response = xhttp.responseText;
		var splited = response.split(",");
		var i;
		for(i=0;i<splited.length-4;i=i+4){
			var x = splited[i];
			//create markers
			var centerMark = new google.maps.LatLng(splited[i+2],splited[i+3]);
			var marker=new google.maps.Marker({
			position:centerMark,
			id : splited[i],
			animation: null,
			icon: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld="+splited[i+1]+"|FF5000|000000"		
			});
			google.maps.event.addListener(marker, 'click', function () {
			window.location.href = 'region.php?section='+document.getElementById('curatorial').innerHTML+'&region='+this.id;
			});
			//google.maps.event.addListener(marker, 'mouseover', function () {
				//var x = this;
				//this.setAnimation(google.maps.Animation.BOUNCE);
				//setTimeout(function(){ x.setAnimation(google.maps.Animation.null); }, 750);					 
			//});
			//attach markers
			marker.setMap(map);
			  
		}
	}
	};
	xhttp.open("GET", "../get_pages/get_occurrences.php?section="+document.getElementById('curatorial').innerHTML, true);
	xhttp.send();
}
function initialize(lat,lon)
{
	var centerMark = new google.maps.LatLng(lat,lon);
	//create map
	var mapProp = {
	center: new google.maps.LatLng(lat,lon),
	zoom:3,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	//attach map
	map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	//create marker
	var marker=new google.maps.Marker({
	position:centerMark,	
	});
	//attach marker
	marker.setMap(map);
    setMarkers();
	
}


function getCoordinates(){
	var xhttp = new XMLHttpRequest();
	var lat;
	var lon;
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	 var response = xhttp.responseText;
	 var splited = response.split(",");	 
	 lat = splited[0];
	 lon = splited[1];
	 console.log(document.getElementById('provenience').innerHTML);
	 console.log(splited[0]);
	 console.log(splited[1]);
	 console.log(splited[2]);
	 initialize(lat,lon);
	}
	};
	xhttp.open("GET", "../get_pages/get_google_data.php?provenience="+document.getElementById('provenience').innerHTML+'&section='+document.getElementById('curatorial').innerHTML, true);
	xhttp.send();
	
	
}
google.maps.event.addDomListener(window, 'load', getCoordinates);