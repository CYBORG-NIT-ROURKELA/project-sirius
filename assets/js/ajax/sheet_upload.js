$(document).ready(function () {
	$("#confirmation").click(function (event) {
		event.preventDefault();
		var fd = new FormData();
		var files = $("#myFile3")[0].files[0];
		fd.append("file", files);
		$.ajax({
			url: "../apis/file_upload.php",
			data: fd,
			type: "POST",
			contentType: false,
			processData: false,
			success: function (response) {
				console.log((response));
				var res = JSON.parse(response);
				if (res.status == "success") {
					swal("Updated Successfully", "", "success").then((value) => {
						window.location = "../views/admin.html";
					});
				} else {
					swal(res.message, "", "error");
				}
			},
		});
	});
});

