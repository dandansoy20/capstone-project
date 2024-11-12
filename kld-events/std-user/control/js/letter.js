$(document).ready(function () {
  $("#admin_approve_btn").click(function () {
    var dataString = {
      ajax: "admin_approve",
      session_id: $("#session_id").val(),
      event_id: $("#event_id").val(),
    };

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      success: function (response) {
        console.log(response);
        // Handle the response (success message, update UI, etc.)
        if (response === "success") {
          Swal.fire(
            "Approved!",
            "The event has been approved.",
            "success"
          ).then(() => {
            location.reload(); // Refresh the page after approval
          });
        } else {
          Swal.fire(
            "Error!",
            "There was an issue updating the status.",
            "error"
          );
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  $("#admin_reject_btn").click(function () {
    var dataString = {
      ajax: "admin_reject",
      session_id: $("#session_id").val(),
      event_id: $("#event_id").val(),
    };

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      success: function (response) {
        console.log(response);
        // Handle the response (success message, update UI, etc.)
        if (response === "success") {
          Swal.fire("Rejected!", "The event has been rejected.", "error").then(
            () => {
              location.reload(); // Refresh the page after rejection
            }
          );
        } else {
          Swal.fire(
            "Error!",
            "There was an issue updating the status.",
            "error"
          );
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });
});

$(document).ready(function () {
  $("#sendCommentBtn").click(function () {
    var comment = $("#kt_maxlength_5").val();

    // Basic validation
    if (comment.trim() === "") {
      Swal.fire("Empty", "Please enter a comment.", "warning");
      return;
    }

    // Prepare data string
    var dataString = {
      ajax: "add_comment",
      session_id: $("#session_id").val(),
      event_id: $("#event_id").val(),
      comment: comment, // Include the comment in the dataString
    };

    console.log("Data sent to server: ", dataString);

    // AJAX request
    $.ajax({
      url: "ajax.php", // Update to your server-side processing file
      type: "POST",
      data: dataString, // Use the dataString object here
      success: function (response) {
        console.log(response);
        if (response === "success") {
          Swal.fire("Sent!", "The comment has been sent.", "success").then(
            () => {
              $("#kt_maxlength_modal").modal("hide");
              $("#kt_maxlength_5").val(""); // Clear the textarea
            }
          );
        } else {
          Swal.fire("Error!", response, "error");
        }
      },

      error: function (xhr, status, error) {
        console.log(xhr.responseText); // Log the error response
        Swal.fire("Fail!", "The comment has not been sent.", "error");
      },
    });
  });
});
