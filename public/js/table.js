$(document).ready(function() {
    table_data();

    var token = localStorage.getItem('user_token');
        if (window.location.pathname === '/') {
            if (token !== null) {
                window.location.href = '/data';
            }
        } else {
            if (token === null) {
                window.location.href = '/';
            }
        }

    $(".logout").click(function() {
            $.ajax({
                url: "http://127.0.0.1:8000/api/auth/logout",
                type: "GET",
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                success: function(data) {
                    if (data.success === true) {
                        localStorage.removeItem('user_token');
                        window.location.href = '/';
                    } else {
                        alert(data.message);
                        localStorage.removeItem('user_token');
                        window.location.href = '/';
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert("Error: " + errorThrown);
                    localStorage.removeItem('user_token');
                    window.location.href = '/';
                }

            });
        });
    });
// ========================================================================
function table_data(){

    $.ajax({
url: "http://127.0.0.1:8000/api/auth/data",
type: "GET",
headers: {
    'Authorization': localStorage.getItem('user_token')
},
success: function(data) {
    if (data.success === true) {
        var counter = 1;
        var tableHtml = "<table class='w-full '>";
        tableHtml += "<thead class='text-gray-500 bg-white'>";
        tableHtml += "<tr><th class='py-2 sm:px-4 lg:px-8 pl-2'>S.No</th><th class='py-2 sm:px-4 lg:px-8 pl-2'>Company</th><th class='py-2 sm:px-4 lg:px-8 pl-2'>Event</th><th class='py-2 sm:px-4 lg:px-8 pl-2'>People</th><th class='py-2 sm:px-4 lg:px-8 pl-2'>Action</th></tr>";
        tableHtml += "</thead>";
        tableHtml += "<tbody>";

        $.each(data.result, function(index, item) {
            
            tableHtml += "<tr class='border border-b-1 shadow-lg my-2 w-full h-20 font-light bg-white'>";
            tableHtml += "<td class='pl-2 py-2 sm:px-4 lg:px-8 bg-white'>" + counter + "</td>";
            tableHtml += "<td class='pl-2 py-2 sm:px-8 bg-white text-ellipsis'>" + item.Company_name + "</td>";
            tableHtml += "<td class='pl-2 py-2 sm:px-4 lg:px-8 bg-white'>" + item.Event_name + "</td>";
            tableHtml += "<td class='pl-2 py-2 sm:px-4 lg:px-8 bg-white'>" + item.Expected_attendees+ "</td>";
            counter++;

            if (item.reply == 0) {
                tableHtml += "<td class='bg-white py-2 px-auto w-full sm:flex sm:justify-center'>";
                tableHtml += "<button class='text-blue-500 border py-2 px-4 rounded-lg send-button ml-1 mt-2 hover:bg-black hover:text-white' data-id='" + item.id + "' data-email='" + item.Email + "'>Send</button>";
                tableHtml += "<button class='bg-blue-500 hover:bg-blue-700 text-white py-2 px-5 mt-2 rounded-lg edit-button ml-1' data-id='" + item.id +  "'data-email='" + item.Email + "'>Edit</button>";
                tableHtml += "<button class=' view-button bg-rose-500 hover:bg-red-400 text-white py-2 px-5 mt-2 rounded-lg ml-1 ' data-id='" + item.id +  "'>view</button>";
                 
            } else {
                tableHtml += "<td class='bg-white py-2 px-auto text-center text-emerald-600 w-full'>";
                tableHtml += "<p class='bg-transparent'>Reply Sent ✓</p>";

            }


            tableHtml += "</td>";
            tableHtml += "</tr>";
        });

        tableHtml += "</tbody>";
        tableHtml += "</table>";
        $("#data_div").html(tableHtml);

        $(".send-button").click(function() { 
            var id = $(this).data("id");
            var email = $(this).data("email");
            console.log(email);
            var message = $(".message").val();

            if (message.trim() === "") {
                $(".message-error").show();
                setTimeout(function() {
                    $(".message-error").hide();
                }, 6000);
            }
            else {
                $(".message-error").hide();
                send_reply(id, email, message);
            }
        });

        $(".edit-button").click(function() {
var id = $(this).data("id");
var email = $(this).data("email");
console.log("ID: " + id);
console.log("Email: " + email); 
var editMessage = $(".Edit_message").val();

$("#myModal").show();
$(".Edit_message").val(editMessage);

$(".edit-save-button").click(function() {
    var updatedMessage = $(".Edit_message").val();
    send_reply(id, email, updatedMessage);
    $("#myModal").hide();
    $(".Edit_message").val("");
});
});
$(".view-button").click(function() {
    var id = $(this).data("id");
    modal_view(id);
    $("#myModal2").show();
  

    
});
    } else {
        console.error("Data is not in the expected format:", data);
    }
},
error: function(xhr, textStatus, errorThrown) {
    console.error("Error: " + errorThrown);
}
});

}

// ========================================================================
function send_reply(id, email, msg) {
    var formData = new FormData();
    formData.append('id', id);
    formData.append('email', email);
    formData.append('message', msg);

    $.ajax({
        url: "http://localhost:8000/api/auth/mail",
        type: "POST",
        data: formData,
        headers: {
            'Authorization': localStorage.getItem('user_token')
        },
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.success === true) {
                table_data();
              
            } else {
                console.error("Mail could not be sent:", data.message);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("Error: " + errorThrown);
        }
    });
}
// ========================================================================modal
const modal = document.getElementById("myModal");

function closeModal() {
modal.style.display = "none";
$(".Edit_message").val("");
}
// -------------------------------modal-1
const modal1 = document.getElementById("myModal1");
const openModalBtn = document.getElementById("messageModal");

openModalBtn.addEventListener("click", () => {
modal1.style.display = "block";
});

function closeModal1() {
modal1.style.display = "none";
}
// --------------------------------modal-2
const modal2 = document.getElementById("myModal2");
const modalcontent2 = document.getElementById("modalcontent-2");

function closeModal2() {
modal2.style.display = "none";
}
// --------------------------------all modal close window-click

window.onclick = function(event) {
if (event.target == modal) {
    closeModal();
} else if (event.target == modal1) {
    closeModal1();
}


modalcontent2.onclick =function(event){
    if(event.target == modalcontent2){
        closeModal2();
    }

}
};

// ========================================================================
function modal_view(id) {
$.ajax({
    url: "http://127.0.0.1:8000/api/auth/view?id=" + id, 
    type: "POST",
    headers: {
        'Authorization': localStorage.getItem('user_token')
    },
    processData: false,
    contentType: false,
    success: function(response) {
        $("#resultDiv").html("");
                    if (response.success){
                       
                        var resultData = response.result[0];
                        
                        var html = '<div class="text-lg  text-sky-500">Name:<p class="text-sm  font-thin text-indigo-950">' + resultData.Name + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">Email: <p class="break-all text-sm font-thin text-indigo-950">' + resultData.Email + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">Company Name:<p class="break-words text-sm font-thin text-indigo-950">' + resultData.Company_name + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">Event Name:<p class="break-words text-sm font-thin text-indigo-950">' + resultData.Event_name + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">Expected Attendees:<p class="text-sm font-thin text-indigo-950 ">' + resultData.Expected_attendees + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">Features:<p class="break-all text-sm font-thin text-indigo-950">' + resultData.Features + '</p></div>';
                        html += '<div class="text-lg  text-sky-500">About: <p class="break-words text-sm font-thin text-indigo-950">' + resultData.About + '</p></div>';

                       
                        
                       
                        $("#resultDiv").html(html);
                    } else {
                        $("#resultDiv").html("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
});
}