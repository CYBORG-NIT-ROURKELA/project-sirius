//cheecks whether form is filled and then uploads
$(document).ready(function() {
    $("#inputImage").on('change', function() {
        var fd = new FormData();
        var files = $('#inputImage')[0].files[0];
        fd.append('file', files);
        $.ajax({
            url: '../apis/template_upload.php',
            data: fd,
            type: "POST",
            contentType: false,
            processData: false,
            success: function(response) {

                // console.log((response));
                var res = JSON.parse(response);
                if (res.status == "success") {
                    swal('Updated Successfully', '', 'success');
                } else {
                    if (res.result == "1") {
                        swal(res.message, '', 'error');
                        window.location = '../views/admin-form.html';
                    } else {
                        swal(res.result, '', 'error');
                    }
                }
            }
        });
    });
});

// Function to preview certificate template
$(function() {
    $("#inputImage").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            $('#previewing').attr('src', 'noimage.png');
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $("#file").css("color", "green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '1000px');
    $('#previewing').attr('height', '648px');
};