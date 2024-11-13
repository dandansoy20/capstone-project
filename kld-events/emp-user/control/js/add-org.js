// Click handler for Add Category Submit
$("#add_org_submit").click(async function () {
  if (orgValidateForm()) {
    var org_pic = await imagefileinsert(document.getElementById("org_pic"));
    var dataString =
      "ajax=add_org" +
      "&org_pic=" +
      org_pic +
      "&org_name=" +
      $("#org_name").val() +
      "&add_org_description=" +
      $("#add_org_description").val();
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
              "Organization saved successfully!",
              "Redirecting...",
              "success"
            );
            setTimeout(function () {
              window.open("?page=organization", "_self");
            }, 3000); // Redirect after 3 seconds
            break;
          case "error":
            Swal.fire(
              "Failed to save organization!",
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
        Swal.fire("Request failed!", "Please check your connection.", "error");
      },
    });
  }
});

$("#edit_org_submit").click(async function () {
  if (orgValidateForm()) {
    var dataString =
      "ajax=edit_org" +
      "&org_pic=" +
      (await imagefileinsert(document.getElementById("org_pic"))) +
      "&org_id=" +
      $("#org_id").val() +
      "&edit_org_name=" +
      $("#edit_org_name").val() +
      "&edit_org_description=" +
      $("#edit_org_description").val();
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
              // Ensure you're using the correct organization_id value here
              var org_id = $("#org_id").val(); // Get the organization_id value
              window.open(`?page=edit-org&id=${org_id}`, "_self");
            }, 3000); // Redirect after 3 seconds
            break;
          case "2":
            Swal.fire(
              "Failed to save organization!",
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
        Swal.fire("Request failed!", "Please check your connection.", "error");
      },
    });
  }
});

// Form validation function
function orgValidateForm() {
  if ($("#org_name").val() == "") {
    Swal.fire(
      "Please specify the organization name!",
      "Please try again!",
      "error"
    );
    return false;
  } else if ($("#add_org_description").val() == "") {
    Swal.fire(
      "Please specify the organization description!",
      "Please try again!",
      "error"
    );
    return false;
  } else if ($("#edit_org_name").val() == "") {
    Swal.fire(
      "Please specify the organization name!",
      "Please try again!",
      "error"
    );
    return false;
  } else if ($("#edit_org_description").val() == "") {
    Swal.fire(
      "Please specify the organization description!",
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
