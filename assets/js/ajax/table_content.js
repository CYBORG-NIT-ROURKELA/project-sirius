function fetch_complete_details4() {
    $.ajax({
        url: "../apis/table_data.php",
        type: "GET",
        success: function(response) {
            var response1 = JSON.parse(response);
            if (response1.result.length == 0) {
                console.log("Empty");
            } else {
                var response = JSON.parse(response);
                add_complete_details4(response);
            }
        },
    });
}

x = 0;
xa = 1;
const count1 = [];
fetch_complete_details4();

function add_complete_details4(response) {
    while (response.result[x].user_name != " ") {
        if (xa == 1) {
            var details = "<tr>";
            details += "<td >" + response.result[x].user_name + "</td>";
            details += "<td>" + response.result[x].email + "</td>";

            details +=
                '<td><button class="btn btn-custon-two btn-success" id="download" download>Download</button></td>';
            details +=
                '<td><button class="btn btn-custon-two btn-warning" id="mail" data-toggle="modal" data-target="#modal-admin-tutorials">Mail</button></td>';
            details += "</tr>";
            $("#tbval").append(details);
        }

        count1.push(response.result[x].user_name);
        x++;
        if (typeof response.result[x] == "undefined") {
            x = 0;
            xa = 0;
            break;
        } else {
            m2 = response.result[x].user_name;
        }
    }
}

$("#tbval").on("click", "#download", function() {
    // get the current row
    var currentRow3 = $(this).closest("tr");
    var name = currentRow3.find("td:eq(0)").text();
    $.ajax({
        url: '../apis/mass_generation.php',
        method: "POST",
        data: {
            name: name,
        },
        success: function(response) {
            // console.log((response));
            var res = JSON.parse(response);

            if (res.status == "success") {
                var file_name = res.result;
                // console.log(file_name);

                var a = document.createElement("a"); //Create <a>
                a.href = "data:image/png;base64," + file_name; //Image Base64 Goes here
                a.download = res.filename + ".png"; //File name Here
                a.click(); //Downloaded file
                
                // var str1 = "../assets/img/certificates/";
                // var str2 = ".jpg";
                // var res = file_name.concat(str2);
                // var res1 = str1.concat(res);
                // saveAs(res1, res);
            } 
            else 
            {
                swal(res.message, '', 'error');
            }
        }
    });
    return false;
});


$("#download_all").click(function(event) {
    event.preventDefault();
    $.ajax({
        url: '../apis/download_all.php',
        type: "POST",
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response);
            // console.log((res.result[2]));

            if (res.status == "success") 
            {
                swal('Successfully Generated', '', 'success');

                        var nombre = "Zip_img";
                        //The function is called
                        compressed_img(res.result, nombre);

                        function compressed_img(urls, nombre) {

                            if(urls.length<=0)
                            {
                                console.log("empty user certificates");
                                return;
                            }
                            var zip = new JSZip();
                            
                            function download(data) {
                                const a = document.createElement("a")
                                a.href = "data:application/zip;base64," + data
                                a.setAttribute("download", nombre + ".zip")
                                a.style.display = "none"
                                a.addEventListener("click", e => e.stopPropagation()) // not relevant for modern browsers
                                document.body.appendChild(a)
                                setTimeout(() => { // setTimeout - not relevant for modern browsers
                                  a.click()
                                  document.body.removeChild(a) 
                                }, 0)
                              }


                            urls.forEach((img, i) => zip.file(res.filenames[i]+".png", img, {base64: true}))
                            zip.generateAsync({type: "base64"}).then(download)
                        }


            } else {
                swal(res.result, '', 'error');
            }
        }
    });
});