$(document).on("click", "#admin_approve_btn", function () {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, approve it!",
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {
          action: "admin_approve", // Action to identify the switch case
        },
        success: function (response) {
          // Handle success response
          Swal.fire("Approved!", response, "success");
        },
        error: function () {
          Swal.fire("Error!", "An error occurred. Please try again.", "error");
        },
      });
    }
  });
});

$(document).on("click", "#admin_reject_btn", function () {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, reject it!",
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {
          action: "admin_reject", // Action to identify the switch case
        },
        success: function (response) {
          // Handle success response
          Swal.fire("Rejected!", response, "success");
        },
        error: function () {
          Swal.fire("Error!", "An error occurred. Please try again.", "error");
        },
      });
    }
  });
});
