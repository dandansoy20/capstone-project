$(document).ready(function () {
  // Click handler for Add Category Submit
  $("#add_cat_submit").click(async function () {
    if (validateForm()) {
      var dataString =
        "ajax=add_cat" +
        "&add_cat_icon=" +
        (await imagefileinsert(document.getElementById("add_cat_icon"))) +
        "&add_cat_category=" +
        $("#add_cat_category").val() +
        "&add_cat_description=" +
        $("#add_cat_description").val();
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
                window.open("category.php", "_self");
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

  $("#edit_cat_submit").click(async function () {
    if (validateForm()) {
      var dataString =
        "ajax=edit_cat" +
        "&edit_cat_icon=" +
        (await imagefileinsert(document.getElementById("edit_cat_icon"))) +
        "&category_id=" +
        $("#category_id").val() +
        "&edit_cat_category=" +
        $("#edit_cat_category").val() +
        "&edit_cat_description=" +
        $("#edit_cat_description").val();
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
                // Ensure you're using the correct category_id value here
                var category_id = $("#category_id").val(); // Get the category_id value
                window.open("?page=edit-cat&id=" + category_id, "_self");
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
});

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

// Form validation function
function validateForm() {
  if ($("#add_cat_category").val() == "") {
    Swal.fire("Please specify the category name!", "Try again.", "error");
    return false;
  } else if ($("#add_cat_description").val() == "") {
    Swal.fire(
      "Please specify the category description!",
      "Try again.",
      "error"
    );
    return false;
  }
  return true;
}
