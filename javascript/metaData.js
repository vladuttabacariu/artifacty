function loadMeta(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	 var response = xhttp.responseText;
     var splited = response.split(",");
	var meta="";
		 meta += '<meta name="language" content="English">';
		 meta += '<meta name="object_name" content="'+splited[0]+'">';
		 meta += '<meta name="culture" content="'+splited[1]+'">';
		 meta += '<meta name="provenience" content="'+splited[2]+'">';
		 meta += '<meta name="creator" content="'+splited[3]+'">';
		 meta += '<meta name="description" content="'+splited[4]+'">';
		 var keywordsSplit = splited[4].split(" ");
		 //alert(keywordsSplit);
		 var keywords="";
		 for(var i=0;i<keywordsSplit.length;i++){
			 keywords += keywordsSplit[i].toLowerCase()+', ';
		 }
		 meta += '<meta name="keywords" content="'+keywords+'">';
	 //alert(meta);
	 document.getElementsByTagName('head')[0].innerHTML += meta;
	}
	};
	xhttp.open("GET", "../get_pages/get_meta.php?&section="+document.getElementById('curatorial').innerHTML+'&id='+document.getElementById('emuIRN').innerHTML, true);
	xhttp.send();
}