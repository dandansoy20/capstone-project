// Click handler for Add Category Submit
$("#add_venue_submit").click(async function () {
  if (venueValidateForm()) {
    $(this).text("Submitting");
    $(this).prop("disabled", "disabled");
    var add_venue_img = await imagefileinsert(
      document.getElementById("add_venue_img")
    );
    var dataString =
      "ajax=add_venue" +
      "&add_venue_img=" +
      add_venue_img +
      "&add_venue=" +
      $("#add_venue").val() +
      "&add_venue_description=" +
      $("#add_venue_description").val();
    console.log("DATASTRING", dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        switch (html) {
          case "success":
            Swal.fire("Venue saved successfully!", "Redirecting...", "success");
            setTimeout(function () {
              window.open("?page=venue", "_self");
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

$("#edit_venue_submit").click(async function () {
  if (venueValidateForm()) {
    $(this).text("Submitting");
    $(this).prop("disabled", "disabled");
    var edit_venue_img = await imagefileinsert(
      document.getElementById("edit_venue_img")
    );
    var dataString =
      "ajax=edit_venue" +
      "&venue_img=" +
      edit_venue_img +
      "&venue_id=" +
      $("#venue_id").val() +
      "&edit_venue=" +
      $("#edit_venue").val() +
      "&edit_venue_description=" +
      $("#edit_venue_description").val();
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
              "Venue updated successfully!",
              "Redirecting...",
              "success"
            );
            setTimeout(function () {
              // Ensure you're using the correct category_id value here
              var venue_id = $("#venue_id").val(); // Get the category_id value
              window.open(`?page=edit-venue&id=${venue_id}`, "_self");
            }, 3000); // Redirect after 3 seconds
            break;
          case "2":
            Swal.fire("Failed to save venue!", "Please try again.", "error");
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

// Form validation function
function venueValidateForm() {
  if ($("#add_venue").val() == "") {
    Swal.fire("Please specify the venue name!", "Please try again!", "error");
    return false;
  } else if ($("#add_venue_description").val() == "") {
    Swal.fire(
      "Please specify the venue description!",
      "Please try again!",
      "error"
    );
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
