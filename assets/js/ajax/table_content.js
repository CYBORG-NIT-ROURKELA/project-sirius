function fetch_complete_details4() {
    $.ajax({
        url: "../apis/table_data.php",
        type: "GET",
        success: function(response) {
            if (response.length == 0) {
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
            console.log((response));
            var res = JSON.parse(response);

            if (res.status == "success") {
                file_name = res.result;
                console.log(file_name);
                var str1 = "../assets/img/certificates/";
                var str2 = ".jpg";
                var res = file_name.concat(str2);
                var res1 = str1.concat(res);
                saveAs(res1, res);
            } else {

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
            console.log((response));
            var res = JSON.parse(response);
            if (res.status == "success") {
                swal('Successfully Generated', '', 'success');
                var folder = "../assets/img/certificates/";
                var x = res.result;
                urls = [];

                $.ajax({
                    url: folder,
                    success: function(data) {
                        $(data).find("a").attr("href", function(i, val) {

                            if ((val.match(/\.(jpe?g|png|gif)$/)) && (val.match(x))) {
                                var res1 = folder.concat(val);
                                urls.push(res1);

                            }
                        });
                        console.log(urls);
                        var nombre = "Zip_img";
                        //The function is called
                        compressed_img(urls, nombre);

                        function compressed_img(urls, nombre) {
                            var zip = new JSZip();
                            var count = 0;
                            var name = nombre + ".zip";
                            urls.forEach(function(url) {
                                console.log("2");
                                JSZipUtils.getBinaryContent(url, function(err, data) {
                                    if (err) {
                                        throw err;
                                    }
                                    zip.file(url, data, {
                                        binary: true
                                    });
                                    count++;
                                    if (count == urls.length) {
                                        zip.generateAsync({
                                            type: 'blob'
                                        }).then(function(content) {
                                            saveAs(content, name);
                                        });
                                    }
                                });
                            });
                        }


                    }
                });


            } else {

                swal(res.message, '', 'error');
            }
        }
    });
});