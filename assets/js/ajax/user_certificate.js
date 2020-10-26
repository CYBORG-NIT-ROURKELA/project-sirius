$(document).ready(function() {
    $.ajax({
        url: '../apis/user_certificate.php',
        type: "GET",
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status == "success") {
                $("#username").html(res.result);
                generate_certificate();
            } else {
                swal(res.result, '', 'error');
                window.location = "../views/feedback.html"
            }

        }
    });
});

function generate_certificate() {
    $.ajax({
        url: '../apis/generate_certificate.php',
        type: 'GET',
        success: function(response) {
            var response = JSON.parse(response);
            // console.log(response.result)
            if (response.status == 'success') {
                $("#certi-img").attr("src", "../assets/img/certificates/" + response.result + ".jpg?" + new Date().getTime());
            }
        }
    });
}
$(document).on('click', '#download-img', function() {
    window.location = "../apis/download.php";
});