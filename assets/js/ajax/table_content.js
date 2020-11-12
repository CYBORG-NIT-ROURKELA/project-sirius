function fetch_complete_details4() {
	$.ajax({
		url: "../apis/table_data.php",
		type: "GET",
		success: function (response) {
			if (response.length == 0) {
				console.log("Empty");
			} else {
				var response = JSON.parse(response);
				add_complete_details4(response);
			}
		},
	});
}
x = 0;
xa = 1;
const count1 = [];
fetch_complete_details4();
function add_complete_details4(response) {
	while (response.result[x].user_name != " ") {
		if (xa == 1) {
			var details = "<tr>";
			details += "<td >" + response.result[x].user_name + "</td>";
			details += "<td>" + response.result[x].email + "</td>";
             
			details +=
				'<td><button class="btn btn-custon-two btn-success" id="tp1" data-toggle="modal" data-target="#modal-admin-tutorials">Download</button></td>';
				details +=
				'<td><button class="btn btn-custon-two btn-warning" id="tp1" data-toggle="modal" data-target="#modal-admin-tutorials">Mail</button></td>';
			details += "</tr>";
			$("#tbval").append(details);
		}

		count1.push(response.result[x].user_name);
		x++;
		if (typeof response.result[x] == "undefined") {
			x = 0;
			xa = 0;
			break;
		} else {
			m2 = response.result[x].user_name;
		}
	}
}