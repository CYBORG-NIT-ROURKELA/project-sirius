$.ajax({
    url: '../apis/check_login.php',
    type: 'POST',
    success: function(response) {
        // console.log(response);
        response = JSON.parse(response);
        if (response.status == "success") {
            // console.log(response.result);
            $('.user_name').html("welcome" + response.result.name + ":)");
        } else {
            swal('Login to continue!', '', 'error').then((value) => {
                window.location = '../views/login.html';
            });
        }
    }
});