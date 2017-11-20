var list = document.getElementById("ft_list");
var button = document.getElementById("create");
var value;
ReadCookie();
button.onclick = function() {
	var a = prompt("What to do", "");
	if (a !== "" && a.replace(/\s/g, "").length > 0) {
		var item = document.createElement("DIV");
		var textitem = document.createTextNode(a);
		item.appendChild(textitem);
		list.insertBefore(item, list.firstChild);
	}
	createCookie();
};

list.onclick = function(e) {
	var conf = confirm("Do you want to remove this TO DO: " + e.target.innerHTML + "?");
	if (conf === true){
		list.removeChild(e.target);
		createCookie();
	}
};

function createCookie() {
	var len = list.childNodes;
	var i = 0;
	var cook = "TODO=";
	while (i < len.length) {
		cook = cook + " " + len[i].innerHTML;
		i++;
	}
	cook = cook + ";";
	document.cookie = cook;
}

function ReadCookie()
{
	var allcookies = document.cookie;
	var name;
	var value_temp;
	var item;
	var textitem;
	var cookiearray = allcookies.split(';');
	for (var i = 0; i < cookiearray.length; i++) {
		name = cookiearray[i].split('=')[0];
		value_temp = cookiearray[i].split('=')[1];
		if (name = "TODO")
			value = value_temp;
	}
	if (value) {
	value = value.split(" ");
		for (i = 0; i < value.length; i++) {
            item = document.createElement("DIV");
            textitem = document.createTextNode(value[i]);
            item.appendChild(textitem);
            list.appendChild(item);
        }
	}
}