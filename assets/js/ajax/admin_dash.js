$.ajax({
  url: "../apis/check_login.php",
  type: "POST",
  success: function (response) {
    // console.log(response);
    response = JSON.parse(response);
    if (response.status == "success") {
      //console.log(response.result.name);
      document.getElementById("admin_name").innerHTML = response.result.name;
      document.getElementById("admin_mail").innerHTML = response.result.email;
      document.getElementById("admin_num").innerHTML = response.result.contact;
      document.getElementById("event_info").innerHTML =
        response.result.event_description;
      document.getElementById("eventn").innerHTML = response.result.event_name;
      document.getElementById("eventd").innerHTML = response.result.event_date;
      document.getElementById("evento").innerHTML =
        response.result.event_organiser;
      console.log(response.result.name.length);
      if (
        response.result.name == "" ||
        response.result.contact == "" ||
        response.result.event_organiser == "" ||
        response.result.event_date == "" ||
        response.result.event_description == ""
      ) {
        swal("Fill up the event details to continue", "", "error").then((value) => {
          window.location = "../views/admin-form.html";
        });
      } else {
      }
    } else {
      swal("Login to continue!", "", "error").then((value) => {
        window.location = "../views/login.html";
      });
    }
  },
});
