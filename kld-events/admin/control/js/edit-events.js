//////////////////////////
$("#add_image").click(async function (event) {
  if (guideValidation()) {
    var guide_image = await imagefileinsert(
      document.getElementById("guide_image")
    );
    var dataString =
      "ajax=add_guide" +
      "&guide_image=" +
      guide_image +
      "&event_id=" +
      $("#event_id").val() +
      "&guide_title=" +
      $("#guide_title").val() +
      "&guide_desc=" +
      $("#guide_desc").val();
    console.log("DATASTRING", dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        switch (html) {
          case "success":
            Swal.fire("Image saved successfully!", "Redirecting...", "success");
            var event_id = $("#event_id").val();
            setTimeout(function () {
              window.open(
                "?page=edit-event&event_id=" + event_id,
                "_self",
                "_self"
              ); // Reload the page after successful submission
            }, 3000); // Redirect after 3 seconds
            break;
          case "error":
            Swal.fire("Failed to save category!", "Please try again.", "error");
            break;
          default:
            Swal.fire("Something went wrong!", "Please try again.", "error");
            console.log(html);
        }
      },
      error: function () {
        Swal.fire("Request failed!", "Please check your connection.", "error");
      },
    });
  }
});

$("#delete_guide").click(function (event) {
  event.preventDefault(); // Prevent the default action

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Check if the user confirmed the deletion
      var guide_id = $("#guide_id").val(); // Ensure guide_id is correctly captured

      var dataString =
        "ajax=delete_guide&event_id=" +
        $("#event_id").val() +
        "&guide_id=" +
        guide_id;
      console.log("DATASTRING", dataString);

      // Perform the AJAX request
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
          switch (html) {
            case "success":
              Swal.fire(
                "Content deleted successfully!",
                "Redirecting...",
                "success"
              );
              var event_id = $("#event_id").val();
              setTimeout(function () {
                window.open("?page=edit-event&event_id=" + event_id, "_self"); // Redirect after successful deletion
              }, 2000); // Redirect after 2 seconds
              break;
            case "error":
              Swal.fire(
                "Failed to delete guide!",
                "Please try again.",
                "error"
              );
              break;
            default:
              Swal.fire("Something went wrong!", "Please try again.", "error");
              console.log(html); // Log any unexpected response
          }
        },
        error: function () {
          Swal.fire(
            "Request failed!",
            "Please check your connection.",
            "error"
          );
        },
      });
    }
  });
});

function guideValidation() {
  if ($("#guide_title").val() == "") {
    Swal.fire("Please specify the title name!", "Please try again!", "error");
    return false;
  } else if ($("#guide_desc").val() == "") {
    Swal.fire("Please specify the description!", "Please try again!", "error");
    return false;
  }
  return true;
}

// Function to convert image to base64
async function imagefileinsert(e) {
  var file = $(e).prop("files")[0];
  if (!file) return false;
  const result = await new Promise((resolve, reject) => {
    var reader = new FileReader();

    reader.onload = function (event) {
      resolve(btoa(event.target.result));
    };

    reader.onerror = function (error) {
      reject(error);
    };

    reader.readAsDataURL(file);
  });
  return result;
}

$("#add_agenda").click(async function (event) {
  if (agendaValidation()) {
    var dataString =
      "ajax=add_agenda" +
      "&event_id=" +
      $("#event_id").val() +
      "&agenda_time=" +
      $("#kt_timepicker_4").val() +
      "&agenda_desc=" +
      $("#agenda_desc").val();
    console.log("DATASTRING", dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        switch (html) {
          case "success":
            Swal.fire(
              "Agenda added successfully!",
              "Redirecting...",
              "success"
            );
            var event_id = $("#event_id").val();
            setTimeout(function () {
              window.open(
                "?page=edit-event&event_id=" + event_id,
                "_self",
                "_self"
              ); // Reload the page after successful submission
            }, 3000); // Redirect after 3 seconds
            break;
          case "error":
            Swal.fire("Failed to save category!", "Please try again.", "error");
            break;
          default:
            Swal.fire("Something went wrong!", "Please try again.", "error");
            console.log(html);
        }
      },
      error: function () {
        Swal.fire("Request failed!", "Please check your connection.", "error");
      },
    });
  }
});

function agendaValidation() {
  if ($("#kt_timepicker_4").val() == "") {
    Swal.fire("Please specify the title name!", "Please try again!", "error");
    return false;
  } else if ($("#agenda_desc").val() == "") {
    Swal.fire("Please specify the description!", "Please try again!", "error");
    return false;
  }
  return true;
}

// Disable Dropzone's auto-discovery
Dropzone.autoDiscover = false;

// Initialize Dropzone
var myDropzone = new Dropzone("#event_file", {
  url: "ajax.php", // Server-side script to handle file upload
  paramName: "file", // Parameter name for the uploaded file
  maxFiles: 1, // Limit to 1 file
  maxFilesize: 10, // File size limit in MB
  acceptedFiles:
    "image/*,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document", // Accepted file types
  addRemoveLinks: true, // Show remove links
  dictDefaultMessage: "Drop files here or click to upload.",
  dictRemoveFile: "Remove file",
  init: function () {
    this.on("maxfilesexceeded", function (file) {
      this.removeAllFiles(); // Remove existing files and add the new one
      this.addFile(file);
    });
  },
});

$("#add_file").click(function () {
  if (myDropzone.files.length > 0) {
    var file = myDropzone.files[0];
    var formData = new FormData();
    formData.append("file", file);
    formData.append("event_id", $("#event_id").val());
    formData.append("ajax", "add_file"); // Add the 'ajax' parameter here

    // Log FormData contents
    console.log("FormData contents: ", formData);

    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response === "success") {
          Swal.fire("File added successfully!", "Redirecting...", "success");
          setTimeout(function () {
            window.location.href =
              "?page=edit-event&event_id=" + $("#event_id").val();
          }, 3000);
        } else {
          Swal.fire("Upload error!", response, "error");
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX error:", status, error);
        Swal.fire(
          "Upload error!",
          "An unexpected error occurred. Please try again.",
          "error"
        );
      },
    });
  } else {
    Swal.fire(
      "No file selected!",
      "Please upload a file before submitting.",
      "warning"
    );
  }
});

$("#add_link").click(async function (event) {
  if (linkValidation()) {
    var dataString =
      "ajax=add_link" +
      "&event_id=" +
      $("#event_id").val() +
      "&link_name=" +
      $("#link_name").val() +
      "&link_url=" +
      $("#link_url").val();
    console.log("DATASTRING", dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        switch (html) {
          case "success":
            Swal.fire("Link added successfully!", "Redirecting...", "success");
            var event_id = $("#event_id").val();
            setTimeout(function () {
              window.open(
                "?page=edit-event&event_id=" + event_id,
                "_self",
                "_self"
              ); // Reload the page after successful submission
            }, 3000); // Redirect after 3 seconds
            break;
          case "error":
            Swal.fire("Failed to save category!", "Please try again.", "error");
            break;
          default:
            Swal.fire("Something went wrong!", "Please try again.", "error");
            console.log(html);
        }
      },
      error: function () {
        Swal.fire("Request failed!", "Please check your connection.", "error");
      },
    });
  }
});

function linkValidation() {
  if ($("#link_name").val() == "") {
    Swal.fire("Please specify the link name!", "Please try again!", "error");
    return false;
  } else if ($("#link_url").val() == "") {
    Swal.fire("Please specify the url!", "Please try again!", "error");
    return false;
  }
  return true;
}
