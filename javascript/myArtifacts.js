function addToMyArtifacts(username,id){
	//alert(username);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	 var response = xhttp.responseText;
	 //alert(response);
	}
	};
	xhttp.open("GET", "../get_pages/insertArtifact.php?&username="+username+"&id="+id, true);
	xhttp.send();
	document.getElementById('addRemoveMyArtifacts').innerHTML = '<span class="addRemoveArtifacts"><a href="javascript:removeFromMyArtifacts(\''+username+'\',\''+id+'\')"><img style="max-height:17px;" src="../images/addremove/minus.png" />Remove from my artifacts</a></span>';
	document.getElementById('message').innerHTML = 'Item added!';
	$('#fixed').css("right","0px");
	setTimeout(function(){ $('#fixed').css("right","-150px"); }, 3000);
	
}

function removeFromMyArtifacts(username,id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	 var response = xhttp.responseText;
	 //alert(response);
	}
	};
	xhttp.open("GET", "../get_pages/removeArtifact.php?&username="+username+"&id="+id, true);
	xhttp.send();
	document.getElementById('addRemoveMyArtifacts').innerHTML = '<span class="addRemoveArtifacts"><a href="javascript:addToMyArtifacts(\''+username+'\',\''+id+'\')"><img style="max-height:17px;" src="../images/addremove/plus.png" />Add to my artifacts</a></span>';
	document.getElementById('message').innerHTML = 'Item removed!';
	$('#fixed').css("right","0px");
	setTimeout(function(){ $('#fixed').css("right","-150px"); }, 3000);
}
function removeFromMyArtifactsList(username,id){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	 var response = xhttp.responseText;
	 //alert(response);
	}
	};
	xhttp.open("GET", "../get_pages/removeArtifact.php?&username="+username+"&id="+id, true);
	xhttp.send();
	
	document.getElementById(id).remove();
}