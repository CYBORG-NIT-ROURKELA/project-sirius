$.ajax({
  url: "../apis/check_login.php",
  type: "POST",
  success: function (response) {
    // console.log(response);
    response = JSON.parse(response);
    if (response.status == "success") {
      console.log(response.result);
      $('#name').val(response.result.name);
      $('#email_id').val(response.result.email);
      $('#contact_number').val(response.result.contact);
      $('#event_dsc').val(response.result.event_description);
      $('#event_name').val(response.result.event_name);
      $('#event_date').val(response.result.event_date);
      $('#event_org').val(response.result.event_organiser);
    } 
    else {
      swal("Error!", "", "error").then((value) => {
        window.location = "../views/login.html";
      });
    }
  },
});
