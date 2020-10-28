$("#enter").click(function(event) {
    event.preventDefault();
    var name = $("#name").val();
    var email = $("#email_id").val();
    var contact_number = $("#contact_number").val();
    var event_name = $("#event_name").val();
    var event_dsc = $("#event_dsc").val();
    var event_date = $("#event_date").val();
    var event_org = $("#event_org").val();
    var fd = new FormData();
    fd.append("name", name);
    fd.append("email", email);
    fd.append("contact_number", contact_number);
    fd.append("event_org", event_org);
    fd.append("event_name", event_name);
    fd.append("event_date", event_date);
    fd.append("event_dsc", event_dsc);
    $.ajax({
        url: '../apis/admin.php',
        data: fd,
        type: "POST",
        contentType: false,
        processData: false,
        success: function(response) {
            console.log((response));
            var res = JSON.parse(response);
            if (res.status == "success") {
                swal('Successfully Added', '', 'success').then((value) => {
                    window.location = '../views/admin.html';
                });
            } else {
                swal(res.message, '', 'error');
            }
        }
    });

});