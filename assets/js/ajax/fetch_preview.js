function fetch_complete_details() {
    $.ajax({
        url: '../apis/fetch_preview.php',
        type: 'GET',
        success: function(response) {
            // console.log(response);
            var response = JSON.parse(response);
            // console.log(response.result);

            if (response.status == 'success') {
                show_details(response);
            }
            else
            {
                console.log(response.result);
            }
        }
    });

    return false;
}

function show_details(response) {
    var path = "../assets/img/templates/"
    var res = path + response.result.template_preview.template_image;
    document.getElementById("previewing").src = res;
}

fetch_complete_details();