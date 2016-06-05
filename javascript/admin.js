function loadTable(id){ 
window.location='../pages/admin.php?table='+id;
}

function deleteFromTable(tbl){
	var item = document.getElementById("selectItem").value;
	if(item==""){
		alert('Select an item to delete!');
	}
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 var response = xhttp.responseText;
		 alert(response);
		}
		};
		xhttp.open("GET", "../get_pages/delete.php?table="+tbl+"&item="+item, true);
		xhttp.send();
		$("#selectItem option[value='"+item+"']").remove();
	}
}
function getItem(tbl){
	var item = document.getElementById("selectItem").value;
	if(item==""){
		alert('Select an item to update!');
	}
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 var response = xhttp.responseText;
		 updateinsert(response);
		}
		};
		xhttp.open("GET", "../get_pages/get_item.php?table="+tbl+"&item="+item, true);
		xhttp.send();
		
	}
}
function updateinsert(data) {
	var x = document.getElementById('updateinsert').style.display='inline-block';
	if(data){
	var split = data.split("$&*");
	var node = document.getElementById('updateinsert');
	for (var i = 0; i < split.length;i++){
		node.children[i].value= split[i];
		console.log(split[i]);
	}
	}
	else{
	var node = document.getElementById('updateinsert');
	for (var i = 0; i < 7;i++){
		node.children[i].value= "";
	}
	}
}
function update(){
	var xhttp = new XMLHttpRequest();
	var node = document.getElementById('updateinsert');
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
	var response = xhttp.responseText;
	console.log(response);
	window.location= '../pages/admin.php'+location.search;
	}
	};
	xhttp.open("GET", "../get_pages/update.php?table="+location.search.replace("?table=","")+"&emuIRN="+node.children[0].value+"&curatorial_section="+node.children[1].value+"&object_name="+node.children[2].value+"&provenience="+node.children[3].value+"&culture="+node.children[4].value+"&material="+node.children[5].value+"&description="+node.children[6].value, true);
	xhttp.send();
}