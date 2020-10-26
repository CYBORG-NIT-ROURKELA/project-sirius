$("#submitted").click(function(event) {
    event.preventDefault();
    var name_user = $("#user_name").val();
    var email_id = $("#email").val();
    var rating = $("#rating").val();
    var suggestions = $("#suggestions").val();
    var comment_abt_event = $("#comment_abt_event").val();
    var fd1 = new FormData();
    fd1.append("name_user", name_user);
    fd1.append("email_id", email_id);
    fd1.append("rating", rating);
    fd1.append("suggestions", suggestions);
    fd1.append("comment_abt_event", comment_abt_event);
    $.ajax({
        url: '../apis/feedback.php',
        data: fd1,
        type: "POST",
        contentType: false,
        processData: false,
        success: function(response) {
            console.log((response));
            var res = JSON.parse(response);
            if (res.status == "success") {
                swal('Successfully Added', '', 'success').then((value) => {
                    window.location = '../views/certificate page.html';
                });
            } else {

                swal(res.message, '', 'error');
            }
        }
    });
});