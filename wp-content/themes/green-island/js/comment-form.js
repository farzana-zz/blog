function formActive(id) {
	var formActOld = document.getElementById(id);
	
	if (formActOld.value == "Name" || formActOld.value == "E-mail" || formActOld.value == "Homepage" || formActOld.value == "Leave a message..."){
		formActOld.value = "";
	}
	
}

function formInActive(id) {
	var formActOld = document.getElementById(id);
	
	if (formActOld.value == ""){
		if (id=="author"){ formActOld.value="Name"; }
		else if (id=="email"){ formActOld.value="E-mail"; }
		else if (id=="url"){ formActOld.value="Homepage"; }
		else if (id=="comment"){ formActOld.value="Leave a message..."; }
	}
	
}