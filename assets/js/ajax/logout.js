$('#signoutBtn').click(() => {

    $.ajax({
        url: './apis/logout.php',
        type: 'POST',
        success: (response) => {
            response = JSON.parse(response);
            swal("Logged out!", "", "success");
            window.location = 'views/login.html';
        }
    });
})