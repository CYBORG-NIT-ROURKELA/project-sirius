//Puts previous values so that admin needn't re-enter everytime he logs in
$(document).ready(function() {
    $.ajax({
        url: '../apis/fetch_preview.php',
        type: 'GET',
        success: function(response) {
            console.log(response);
            var response = JSON.parse(response);
            console.log(response);
            if (response.status == 'success') {
                // console.log(response.result);
                put_existing_values(response);
            } else {
                window.location = "./login.html";
            }
        }

    });
});

function put_existing_values(response) {
    $("#font-style").val(response.result.template_preview['font_type']);
    $("#font-size").val(response.result.template_preview['font_size']);
    var res = response.result.template_preview['font_color'].split(",", 3);
    $("#color-r").val(res[0]);
    $("#color-g").val(res[1]);
    $("#color-b").val(res[2]);
    $("#x-coordinate").val(response.result.template_preview['x_coordinate']);
    $("#y-coordinate").val(response.result.template_preview['y_coordinate']);
}

//Upload of new values
$(document).ready(function() {
    $("#preview-btn").on('click', (function(e) {
        e.preventDefault();
        var fstyle = $("#font-style").val();
        var fsize = $("#font-size").val();
        var rcolor = $("#color-r").val();
        var gcolor = $("#color-g").val();
        var bcolor = $("#color-b").val();
        var xcoordinate = $("#x-coordinate").val();
        var ycoordinate = $("#y-coordinate").val();

        // console.log(name);

        $.ajax({
            url: '../apis/styles_upload.php',
            data: {
                fstyle: fstyle,
                fsize: fsize,
                rcolor: rcolor,
                gcolor: gcolor,
                bcolor: bcolor,
                xcoordinate: xcoordinate,
                ycoordinate: ycoordinate

            },
            type: 'POST',
            success: function(response) {
                // console.log(response);

                var res = JSON.parse(response);
                if (res.status == "success") {

                    swal('Styles uploaded!', '', 'success').then((value) => {
                        show_certificate();
                    });
                } else {
                    swal(res.result, '', 'error');

                }
            }
        });
        return false;
    }));
    return false;
});

//To show certificate after changing values
function show_certificate() {
    $.ajax({
        url: '../apis/generate_certificate.php',
        type: 'GET',
        success: function(response) {
            var response = JSON.parse(response);
            // console.log(response.result)
            if (response.status == 'success') {

                $("#previewing").attr("src", "../assets/img/certificates/" + response.result + ".jpg?" + new Date().getTime());
                // document.getElementById("previewing").src = "../assets/img/certificates/" + response.result + ".jpg";
            }
        }
    })
}

//Download certificate
$("#download-img").on('click', () => {
    window.location = "../apis/download.php"
});