$("#add_admin_submit").click(async function () {
  if (adminValidateForm()) {
    $(this).text("Submitting");
    $(this).prop("disabled", "disabled");
    var dataString =
      "ajax=add_admin" +
      "&add_admin_profilepic=" +
      (await imagefileinsert(document.getElementById("add_admin_profilepic"))) +
      "&add_admin_fname=" +
      $("#add_admin_fname").val() +
      "&add_admin_lname=" +
      $("#add_admin_lname").val() +
      "&add_admin_role=" +
      $("#add_admin_role").val() +
      "&add_admin_email=" +
      $("#add_admin_email").val();
    console.log(dataString);
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        switch (html) {
          case "success":
            Swal.fire(
              "Account successfully created!",
              "Redirecting to homepage...",
              "success"
            );
            setTimeout(
              function () {
                window.open("login.php", "_self");
              },
              2000 // 2 seconds
            );

            break;
          case "failed":
            alert("Not saved!");
            break;
          default:
            alert("Something went wrong, please try again.");
            console.log(html);
        }
      },
    });
  }
});

async function imagefileinsert(e) {
  var file = $(e).prop("files")[0];
  if (!file) return false;
  const result = await new Promise((resolve, reject) => {
    var reader = new FileReader();

    reader.onload = function (event) {
      // Resolve the promise with the base64 encoded string
      resolve(btoa(event.target.result)); // Get the base64 part
    };

    reader.onerror = function (error) {
      reject(error);
    };

    reader.readAsDataURL(file);
  });
  return result;
}

function adminValidateForm() {
  if ($("#add_admin_fname").val() == "") {
    Swal.fire("Please specify the first name!", "Please try again!", "error");
    return false;
  } else if ($("#add_admin_lname").val() == "") {
    Swal.fire("Please specify the last name!", "Please try again!", "error");
    return false;
  } else if ($("#add_admin_role").val() == "") {
    Swal.fire("Please specify the role!", "Please try again!", "error");
    return false;
  } else if ($("#add_admin_email").val() == "") {
    Swal.fire("Please specify the KLD Number!", "Please try again!", "error");
    return false;
  }
  return true;
}
