$("#launch-event").click(function () {
  Swal.fire({
    title: "Are you sure you want to launch the event?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Don't launch`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).text("Submitting");
      $(this).prop("disabled", "disabled");
      var dataString = {
        ajax: "launch",
        event_id: $("#event_id").val(),
      };

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          // Handle the response (success message, update UI, etc.)
          if (response === "success") {
            Swal.fire("Great!", "The event has been launched.", "success").then(
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
              "There was an issue launching the event.",
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

$("#cancel-event").click(function () {
  Swal.fire({
    title: "Are you sure you want to cancel the event?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Don't launch`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).text("Submitting");
      $(this).prop("disabled", "disabled");
      var dataString = {
        ajax: "cancel",
        event_id: $("#event_id").val(),
      };

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          // Handle the response (success message, update UI, etc.)
          if (response === "success") {
            Swal.fire(
              "Cancelled!",
              "The event has been cancelled.",
              "success"
            ).then(() => {
              var event_id = $("#event_id").val();
              window.open(`?page=upcoming-view&event_id=${event_id}`, "_self");
            });
          } else {
            Swal.fire(
              "Error!",
              "There was an issue launching the event.",
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

$("#end-event").click(function () {
  Swal.fire({
    title: "Are you sure you want to end the event?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Cancel`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).text("Submitting");
      $(this).prop("disabled", "disabled");
      var dataString = {
        ajax: "complete",
        event_id: $("#event_id").val(),
      };

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          // Handle the response (success message, update UI, etc.)
          if (response === "success") {
            Swal.fire(
              "Completed!",
              "The event has been ended.",
              "success"
            ).then(() => {
              var event_id = $("#event_id").val();
              window.open(`?page=completed-view&event_id=${event_id}`, "_self");
            });
          } else {
            Swal.fire(
              "Error!",
              "There was an issue completing the event.",
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

$("#archive-event").click(function () {
  Swal.fire({
    title: "Are you sure you want to archive the event?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Cancel`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).text("Submitting");
      $(this).prop("disabled", "disabled");
      var dataString = {
        ajax: "complete",
        event_id: $("#event_id").val(),
      };

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          // Handle the response (success message, update UI, etc.)
          if (response === "success") {
            Swal.fire(
              "Done!",
              "The event has been added to the archive.",
              "success"
            ).then(() => {
              var event_id = $("#event_id").val();
              window.open(`?page=archived-view&event_id=${event_id}`, "_self");
            });
          } else {
            Swal.fire(
              "Error!",
              "There was an issue archiving the event.",
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
