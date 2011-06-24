var http_req = false;
function gcfPOSTRequest(url, parameters) {
  http_req = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_req = new XMLHttpRequest();
	 if (http_req.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_req.overrideMimeType('text/xml');
		http_req.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_req = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_req) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  //alert(parameters);
  http_req.onreadystatechange = gcfContents;
  http_req.open('POST', url, true);
  http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_req.setRequestHeader("Content-length", parameters.length);
  http_req.setRequestHeader("Connection", "close");
  http_req.send(parameters);
}

function gcfContents() 
{
  //alert(http_req.responseText);
  if (http_req.readyState == 4) 
  {
	 if (http_req.status == 200) 
	 {
		//alert(http_req.responseText);
		if(http_req.responseText == "Invalid security code.")
		{
			alert(http_req.responseText);
			result = http_req.responseText;
			document.getElementById('gcf_alertmessage').innerHTML = result;
			document.getElementById("gcf_captcha").value = "";
		}
		else
		{
			alert(http_req.responseText);
			result = http_req.responseText;
			document.getElementById('gcf_alertmessage').innerHTML = result;   
			document.getElementById("gcf_email").value = "";
			document.getElementById("gcf_name").value = "";
			document.getElementById("gcf_message").value = "";
			document.getElementById("gcf_captcha").value = "";
		}
	 } 
	 else 
	 {
		alert('There was a problem with the request.');
	 }
  }
}

function gcf_submit(obj,url) 
{
	
	
	_e=document.getElementById("gcf_email");
	_n=document.getElementById("gcf_name");
	_m=document.getElementById("gcf_message");
	_c=document.getElementById("gcf_captcha");
	
	if(_n.value=="")
	{
		alert("Please enter the name.");
		_n.focus();
		return false;    
	}
	else if(_e.value=="")
	{
		alert("Please enter the email address.");
		_e.focus();
		return false;    
	}
	else if(_e.value!="" && (_e.value.indexOf("@",0)==-1 || _e.value.indexOf(".",0)==-1))
	{
		alert("Please enter valid email.")
		_e.focus();
		_e.select();
		return false;
	} 
	else if(_m.value=="")
	{
		alert("Please enter your message.");
		_m.focus();
		return false;    
	}
	else if(_c.value=="")
	{
		alert("Please enter enter below security code.");
		_c.focus();
		return false;    
	}

	document.getElementById('gcf_alertmessage').innerHTML = "Sending..."; 
	
	var str = "gcf_name=" + encodeURI( document.getElementById("gcf_name").value ) + "&gcf_email=" + encodeURI( document.getElementById("gcf_email").value ) + "&gcf_message=" + encodeURI( document.getElementById("gcf_message").value ) + "&gcf_captcha=" + encodeURI( document.getElementById("gcf_captcha").value );
				 
	gcfPOSTRequest(url+'simple-contact-save.php', str);
}
