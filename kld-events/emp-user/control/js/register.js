$("#register_event").click(function () {
  Swal.fire({
    title: "Are you sure you want to register for the event?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Don't Register`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).text("Submitting");
      $(this).prop("disabled", "disabled");
      var dataString = {
        ajax: "emp_register",
        event_id: $("#event_id").val(),
        emp_id: $("#emp_id").val(),
      };

      $.ajax({
        type: "POST",
        url: "../admin/ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          // Handle the response (success message, update UI, etc.)
          if (response === "success") {
            Swal.fire("Great!", "You are now registered.", "success").then(
              () => {
                var event_id = $("#event_id").val();
                window.open(
                  `?page=upcoming-view&event_id=${event_id}`,
                  "_self"
                );
              }
            );
          } else {
            Swal.fire(
              "Error!",
              "There was an issue registering for the event.",
              "error"
            ).then(() => {
              location.reload();
            });
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
        },
      });
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});
