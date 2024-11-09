function courseValidateForm() {
  if ($("#add_course_name").val() == "") {
    Swal.fire("Please specify the course name!", "Try again.", "error");
    return false;
  } else if ($("#add_course_acronym").val() == "") {
    Swal.fire("Please specify the course acronym!", "Try again.", "error");
    return false;
  } else if ($("#add_course_description").val() == "") {
    Swal.fire("Please specify the course description!", "Try again.", "error");
    return false;
  }

  return true; // Return true if all checks pass
}

$(document).ready(function () {
  // Click handler for Add Category Submit
  $("#add_course_submit").click(async function () {
    if (courseValidateForm()) {
      var dataString =
        "ajax=add_course" +
        "&add_course_name=" +
        $("#add_course_name").val() +
        "&add_course_description=" +
        $("#add_course_description").val() +
        "&add_course_acronym=" +
        $("#add_course_acronym").val();
      console.log(dataString);

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
          switch (html) {
            case "1":
              Swal.fire(
                "Category saved successfully!",
                "Redirecting...",
                "success"
              );
              setTimeout(function () {
                window.open("?page=course", "_self");
              }, 3000); // Redirect after 3 seconds
              break;
            case "2":
              Swal.fire(
                "Failed to save category!",
                "Please try again.",
                "error"
              );
              break;
            default:
              Swal.fire("Something went wrong!", "Please try again.", "error");
              console.log(html);
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

  $("#edit_course_submit").click(async function () {
    if (validateForm()) {
      var dataString =
        "ajax=edit_course" +
        "&course_id=" +
        $("#course_id").val() +
        "&edit_course_name=" +
        $("#edit_course_name").val() +
        "&edit_course_acronym=" +
        $("#edit_course_acronym").val() +
        "&edit_course_description=" +
        $("#edit_course_description").val();
      console.log(dataString);

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
          switch (html) {
            case "1":
              Swal.fire(
                "Course saved successfully!",
                "Redirecting...",
                "success"
              );
              setTimeout(function () {
                // Ensure you're using the correct course_id value here
                var course_id = $("#course_id").val(); // Get the course_id value
                window.open(
                  "?page=edit-course&course_id=" + course_id,
                  "_self"
                );
              }, 3000); // Redirect after 3 seconds
              break;
            case "2":
              Swal.fire("Failed to save course!", "Please try again.", "error");
              break;
            default:
              Swal.fire("Something went wrong!", "Please try again.", "error");
              console.log(html);
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
