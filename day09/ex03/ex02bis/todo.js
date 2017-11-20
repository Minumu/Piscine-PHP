var value;
ReadCookie();
$('#create').click(function() {
	var a = prompt("What to do", "");
	if (a !== "" && a.replace(/\s/g, "").length > 0) {
		var item = $("<div></div>").text(a);
		$('#ft_list').prepend(item);
	}
	createCookie();
});

$('#ft_list').click(function(event) {
	var conf = confirm("Do you want to remove this TO DO: " + $(event.target).text() + "?");
	if (conf === true){
		$(event.target).remove();
		createCookie();
	}
});

function createCookie() {
	var len = $('#ft_list').children();
	console.log(len);
	var i = 0;
	var cook = "TODO=";
	while (i < len.length) {
		cook = cook + " " + $(len[i]).text();
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
            item = $("<div></div>").text(value[i]);
            $('#ft_list').append(item);
        }
    }
}