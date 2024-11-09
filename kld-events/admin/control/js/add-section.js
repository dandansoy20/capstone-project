$(document).ready(function () {
  // Click handler for Add Category Submit
  $("#add_section_submit").click(async function () {
    if (sectionValidateForm()) {
      var dataString =
        "ajax=add_section" +
        "&add_section_name=" +
        $("#add_section_name").val() +
        "&course_id=" +
        $("#course_id").val() +
        "&yearlvl=" +
        $("#yearlvl").val();
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
                "Section saved successfully!",
                "Redirecting...",
                "success"
              );
              setTimeout(function () {
                window.open("?page=course", "_self");
              }, 3000); // Redirect after 3 seconds
              break;
            case "2":
              Swal.fire(
                "Failed to save section!",
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

  $("#edit_section_submit").click(async function () {
    if (validateForm()) {
      var dataString =
        "ajax=edit_section" +
        "&section_id=" +
        $("#section_id").val() +
        "&edit_section_name=" +
        $("#edit_section_name").val() +
        "&edit_section_acronym=" +
        $("#edit_section_acronym").val() +
        "&edit_section_description=" +
        $("#edit_section_description").val();
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
                "Section saved successfully!",
                "Redirecting...",
                "success"
              );
              setTimeout(function () {
                // Ensure you're using the correct section_id value here
                var section_id = $("#section_id").val(); // Get the section_id value
                window.open(
                  "?page=edit-section&section_id=" + section_id,
                  "_self"
                );
              }, 3000); // Redirect after 3 seconds
              break;
            case "2":
              Swal.fire(
                "Failed to save section!",
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
});

// Form validation function
function sectionValidateForm() {
  if ($("#add_section_name").val() == "") {
    Swal.fire("Please specify the section name!", "Try again.", "error");
    return false;
  } else if ($("#add_section_acronym").val() == "") {
    Swal.fire("Please specify the section acronym!", "Try again.", "error");
    return false;
  } else if ($("#add_section_description").val() == "") {
    Swal.fire("Please specify the section description!", "Try again.", "error");
    return false;
  }
  return true;
}
