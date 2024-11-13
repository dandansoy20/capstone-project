$("#add_emp_submit").click(async function () {
  if (empValidateForm()) {
    var dataString =
      "ajax=add_emp" +
      "&add_emp_profilepic=" +
      (await imagefileinsert(document.getElementById("add_emp_profilepic"))) +
      "&add_emp_firstname=" +
      $("#add_emp_firstname").val() +
      "&add_emp_lastname=" +
      $("#add_emp_lastname").val() +
      "&add_emp_role=" +
      $("#add_emp_role").val() +
      "&add_emp_org=" +
      $("#add_emp_org").val() +
      "&add_emp_kldnum=" +
      $("#add_emp_kldnum").val() +
      "&add_emp_email=" +
      $("#add_emp_email").val();
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
                window.open("index.php", "_self");
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

function empValidateForm() {
  if ($("#add_emp_firstname").val() == "") {
    Swal.fire("Please specify the First Name!", "Please try again!", "error");
    return false;
  } else if ($("#add_emp_lastname").val() == "") {
    Swal.fire("Please specify the Last Name!", "Please try again!", "error");
    return false;
  } else if ($("#add_emp_role").val() == "") {
    Swal.fire("Please specify the Position!", "Please try again!", "error");
    return false;
  } else if ($("#add_emp_org").val() == "") {
    Swal.fire("Please specify the organization!", "Please try again!", "error");
    return false;
  } else if ($("#add_emp_kldnum").val() == "") {
    Swal.fire(
      "Please specify the Employee Number!",
      "Please try again!",
      "error"
    );
    return false;
  } else if ($("#add_emp_email").val() == "") {
    Swal.fire("Please specify the email!", "Please try again!", "error");
    return false;
  }
  return true;
}

// empty placeholder
$("#add_emp_kldnum").inputmask("mask", {
  mask: "K-99999",
  placeholder: "", // remove underscores from the input mask
});
