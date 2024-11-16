$(document).ready(function () {
  // Enable section dropdown when both Course and Year Level are selected
  $("#add_std_course, #add_std_yearlvl").change(function () {
    const selectedCourse = $("#add_std_course").val();
    const selectedYearLevel = $("#add_std_yearlvl").val();
    const sectionDropdown = $("#add_std_section");
    const allSections = $("#std_add_section_options option");

    // Check if both course and year level are selected
    if (selectedCourse && selectedYearLevel) {
      // Enable the section dropdown
      sectionDropdown.prop("disabled", false);

      // Clear the current options and add a placeholder
      sectionDropdown
        .empty()
        .append("<option selected disabled>Select Section</option>");

      // Filter and append matching sections
      allSections.each(function () {
        const course = $(this).data("course");
        const yearLevel = $(this).data("yrlvl");

        if (course == selectedCourse && yearLevel == selectedYearLevel) {
          sectionDropdown.append(
            '<option value="' +
              $(this).val() +
              '">' +
              $(this).text() +
              "</option>"
          );
        }
      });
    } else {
      // Disable the section dropdown if either field is not selected
      sectionDropdown
        .prop("disabled", true)
        .empty()
        .append("<option selected disabled>Select Section</option>");
    }
  });
});

$("#add_std_submit").click(async function () {
  if (stdValidateForm()) {
    $(this).text("Submitting");
    $(this).prop("disabled", "disabled");
    var dataString =
      "ajax=add_std" +
      "&add_std_profilepic=" +
      (await imagefileinsert(document.getElementById("add_std_profilepic"))) +
      "&add_std_firstname=" +
      $("#add_std_firstname").val() +
      "&add_std_lastname=" +
      $("#add_std_lastname").val() +
      "&add_std_course=" +
      $("#add_std_course").val() +
      "&add_std_yearlvl=" +
      $("#add_std_yearlvl").val() +
      "&add_std_section=" +
      $("#add_std_section").val() +
      "&add_std_kldnum=" +
      $("#add_std_kldnum").val() +
      "&add_std_email=" +
      $("#add_std_email").val();
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

function stdValidateForm() {
  if ($("#add_std_course").val() == "") {
    Swal.fire("Please specify the course!", "Please try again!", "error");
    return false;
  } else if ($("#add_std_yearlvl").val() == "") {
    Swal.fire("Please specify the year level!", "Please try again!", "error");
    return false;
  } else if ($("#add_std_section").val() == "") {
    Swal.fire("Please specify the section!", "Please try again!", "error");
    return false;
  } else if ($("#add_std_kldnum").val() == "") {
    Swal.fire("Please specify the KLD Number!", "Please try again!", "error");
    return false;
  } else if ($("#add_std_email").val() == "") {
    Swal.fire("Please specify the email!", "Please try again!", "error");
    return false;
  }
  return true;
}

// empty placeholder
$("#add_std_kldnum").inputmask("mask", {
  mask: "KLD-99-999999",
  placeholder: "", // remove underscores from the input mask
});
