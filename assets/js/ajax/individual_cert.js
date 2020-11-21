var file_name=" ";
$("#enter").click(function(event) {
    event.preventDefault();
    var email_id = $("#user_email").val();
    var fd2 = new FormData();
    fd2.append("email_id", email_id);
    $.ajax({
        url: '../apis/check.php',
        data: fd2,
        type: "POST",
        contentType: false,
        processData: false,
        success: function(response) {
            console.log((response));
            var res = JSON.parse(response);
            if (res.status == "success") {
                swal('Congrats on Attending the session', '', 'success');
                file_name = res.result;
                var str1 = "../assets/img/certificates/";
                var str2 = ".jpg";
                var res = file_name.concat(str2);
                var res1 = str1.concat(res);
                document.getElementById("image_cert").src = res1;
                console.log(res1);
            } else {
                if(res.message=="Feedback")
                {
                    swal("Feedback form needs to be filled first", '', 'error').then((value) => {
                        window.location = '../views/feedback.html';
                    });
                }
                else
                {
                swal(res.message, '', 'error');
                }
                
            }
        }
    });
});
$("#download_cert").click(function(event) {
    event.preventDefault();
    if(file_name!=" ")
    {
        
                var str1 = "../assets/img/certificates/";
                var str2 = ".jpg";
                var res = file_name.concat(str2);
                var res1 = str1.concat(res);
                saveAs(res1, res);
                swal('Congrats on Attending the session', '', 'success');
    }
    else
    {
        swal("Enter Details", '', 'error');
    }
});