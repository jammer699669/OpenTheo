function xmlhttpPost(url, method, divname, qstr)
{
	var xmlHttpReq = false;
	var self = this;
	document.getElementById(divname).innerHTML = "<br><center><img src='ajaxloadergreen64.gif' /></center>";
	// Mozilla/Safari
	if (window.XMLHttpRequest)
	{
		self.xmlHttpReq = new XMLHttpRequest();
	}
	// IE
	else if (window.ActiveXObject)
	{
		self.xmlHttpReq = new ActiveXObject('Microsoft.XMLHTTP');
	}
	self.xmlHttpReq.open(method, url, true);
	self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	self.xmlHttpReq.onreadystatechange = function()
	{
		if (self.xmlHttpReq.readyState == 4)
		{
			updateDiv(self.xmlHttpReq.responseText, divname); //div update function call
		}
	};
	self.xmlHttpReq.send(qstr);
}


//Updating output

function updateDiv(txtvalue, divname)
{
	if (divname)
	{
		document.getElementById(divname).innerHTML = '';
		document.getElementById(divname).innerHTML = txtvalue;




	}
}


function ajaxRC( divname, tword)
{
	//var value = sel.value;
	//	window.alert(5 + 6);

	var qstr = 'tword=' + tword ;
	xmlhttpPost('processword.php', 'POST', divname, qstr);
}
