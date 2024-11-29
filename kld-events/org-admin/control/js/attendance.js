// Event listener for the attendance toggle
$(document).on("change", 'input[name="switch"][type="checkbox"]', function () {
  var std_id = $(this).data("std-id");
  var event_id = $(this).data("event-id");
  var status = $(this).is(":checked") ? "attended" : "absent";
  var originalStatus = $(this).prop("checked"); // Save the original state of the checkbox

  // Confirm the action with SweetAlert
  Swal.fire({
    title:
      "Mark this user as " + (status === "attended" ? "attended?" : "absent?"),
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Yes",
    denyButtonText: `Cancel`,
  }).then((result) => {
    if (result.isConfirmed) {
      $(this).prop("disabled", true); // Disable the checkbox while processing

      var dataString = {
        ajax: "std_attended",
        event_id: event_id,
        std_id: std_id,
        status: status, // Send status based on checkbox state
      };

      // Send AJAX request to update attendance
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          if (response === "success") {
            // Show success notification with SweetAlert
            Swal.fire(
              "Done!",
              "This user is marked as " + status + ".",
              "success"
            ).then(() => {
              // Dynamically update the row without reloading the page
              var row = datatable
                .getDataSourceParam("data")
                .find((row) => row.std_id == std_id);
              if (row) {
                row.status = status; // Update the status
                row.attendance_date =
                  status === "attended"
                    ? moment().format("MMMM D, YYYY, h:mm A")
                    : "---------"; // Update attendance date
                // Update the table row to reflect the changes
                datatable.updateRow(row);
              }
            });
          } else {
            // Show error notification with SweetAlert
            Swal.fire(
              "Error!",
              "There was an issue updating the status.",
              "error"
            ).then(() => {
              location.reload();
            });
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Show error notification if AJAX fails
          Swal.fire(
            "Error!",
            "There was an issue with the request. Please try again.",
            "error"
          );
        },
      });
    } else if (result.isDenied) {
      // Revert the checkbox to its original state if canceled
      Swal.fire("Changes are not saved", "", "info");
      $(this).prop("checked", originalStatus);
    }
  });
});

$(document).ready(function () {
  // Configuration for the main datatable
  var eventID = $("#event_id").val();

  // Initialize the KTDatatable
  var datatable = $("#attendance_std").KTDatatable({
    data: {
      type: "remote", // Load data remotely
      source: {
        read: {
          url: "ajax.php", // URL for fetching data
          method: "POST", // HTTP method
          params: {
            ajax: "attendance-std",
            event_id: eventID, // Pass the event_id dynamically
          },
        },
      },
      pageSize: 10, // Rows per page
    },

    search: {
      input: $("#datatable_search"),
    },
    sortable: true, // Enable sorting
    layout: {
      scroll: false, // Disable scrolling
      footer: false, // Hide footer
    },
    columns: [
      {
        field: "std_id",
        title: `
        <label class="checkbox checkbox-inline">
											
          <input type="checkbox" id="select_all_checkbox">
											<span></span>
										</label>
        `,
        sortable: false,
        width: 30,
        textAlign: "center",
        template: function (row) {
          return `
          
        <label class="checkbox checkbox-inline">
            <input type="checkbox" class="kt-checkbox" data-std-id="${row.std_id}">
            
											<span></span>
										</label>
          `;
        },
      },

      {
        field: "std_profilepic",
        title: "",
        width: 50,
        template: function (row) {
          return `
            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
              <img src="${row.std_profilepic}" class="h-75 align-self-end" alt="">
            </div>`;
        },
      },
      {
        field: "std_lname",
        title: "Full Name",
        width: 150,
        template: function (row) {
          return `
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
              ${row.std_fname} ${row.std_lname}
            </a>
            <span class="text-muted font-weight-bold text-muted d-block">${row.std_kld_id}</span>`;
        },
      },
      { field: "course_acronym", title: "Program", width: 100 },
      { field: "yearlvl_name", title: "Year Level" },
      { field: "section_name", title: "Section" },
      {
        field: "attendance_date",
        title: "Date",
        width: 150,
        template: function (row) {
          let status = "Absent"; // Default status
          let attendance_date = "---------"; // Default date when not attended

          // If the attendance status is "attended", display the date
          if (row.status === "attended") {
            status = "Attended";
            attendance_date = row.attendance_date
              ? moment(row.attendance_date).format("MMMM D, YYYY, h:mm A")
              : "---------"; // Format the date or use default
          }

          return `
            <span class="text-muted font-weight-bolder d-block font-size-lg">${attendance_date}</span>
          `;
        },
      },
      {
        field: "status",
        title: "Status",
        width: 200,
        template: function (row) {
          let status = "Absent"; // Default status
          let label_class = "label-light-danger"; // Default class for "Absent"

          // If the attendance status is "attended", set the appropriate class and label
          if (row.status === "attended") {
            status = "Attended";
            label_class = "label-light-primary"; // Class for "Attended"
          }

          return `
            <span class="label label-lg ${label_class} label-inline">${status}</span>
          `;
        },
      },
      {
        field: "attendance_toggle",
        title: "Action",
        width: 100,
        template: function (row) {
          // Set the checkbox checked or unchecked based on attendance status
          let isChecked = row.status === "attended" ? 'checked="checked"' : "";

          return `
              <form method="post">
                <input type="hidden" id="std_id" name="std_id" value="${row.std_id}"/>
                <input type="hidden" id="event_id" name="event_id" value="${eventID}"/>
                <span class="switch switch-outline switch-icon switch-success">
                  <label>
                    <input type="checkbox" name="switch" class="attended-checkbox" ${isChecked} data-std-id="${row.std_id}" data-event-id="${eventID}" name="select"/>
                    <span></span>
                  </label>
                </span>
              </form>
          `;
        },
      },
    ],
  });

  $(document).on("change", "#select_all_checkbox", function () {
    var isChecked = $(this).is(":checked");

    // Toggle all row checkboxes based on the header checkbox
    $(".kt-checkbox").prop("checked", isChecked).trigger("change");
  });

  var selectedRecords = [];
  var eventID = $("#event_id").val(); // Assuming eventID is available as a global variable

  // Event delegation for individual checkboxes
  $(document).on("change", " input[type='checkbox']", function () {
    var std_id = $(this).data("std-id"); // Get the student ID from the checkbox's data attribute
    if (!std_id) {
      console.error(
        "std_id is undefined. Ensure the checkbox has a valid data-std-id attribute."
      );
      return;
    }

    // Check if the checkbox is checked
    if ($(this).is(":checked")) {
      if (!selectedRecords.includes(std_id)) {
        selectedRecords.push(std_id); // Add to selected records
      }
    } else {
      // Remove from selected records
      selectedRecords = selectedRecords.filter(function (id) {
        return id !== std_id;
      });
    }

    // Update the selected records count display
    console.log("Selected Records:", selectedRecords);
    $("#kt_datatable_selected_records").text(selectedRecords.length);

    // Toggle the visibility of the group action form
    toggleGroupActionForm();
  });

  // Function to toggle the visibility of the group action form
  function toggleGroupActionForm() {
    if (selectedRecords.length > 0) {
      $("#kt_datatable_group_action_form").collapse("show");
    } else {
      $("#kt_datatable_group_action_form").collapse("hide");
    }
  }

  // Handle "Present" and "Absent" actions
  $("#mark-present").on("click", function () {
    updateAttendanceStatus("attended");
  });

  $("#mark-absent").on("click", function () {
    updateAttendanceStatus("absent");
  });

  // Function to update the attendance status of selected records
  function updateAttendanceStatus(status) {
    console.log({
      ajax: "update-attendance-status",
      event_id: eventID,
      std_ids: selectedRecords, // Send selected student IDs
      status: status,
    });

    // Check if selectedRecords is empty before sending AJAX
    if (selectedRecords.length === 0) {
      Swal.fire(
        "No records selected!",
        "Please select students to update.",
        "warning"
      );
      return; // Exit the function if no records are selected
    }

    // Send AJAX request to update the attendance status of the selected records
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: {
        ajax: "update-attendance-status",
        event_id: eventID,
        std_ids: selectedRecords, // Pass the array of selected student IDs
        status: status,
      },
      success: function (response) {
        console.log("Response:", response);
        if (response === "success") {
          Swal.fire(
            "Success!",
            "Attendance status updated for selected students.",
            "success"
          ).then(() => {
            // Reload the datatable or refresh the page
            datatable.reload(); // Make sure `datatable` is the correct object
            $("#std_attendance_count").text("0"); // Reset the count display
            selectedRecords = []; // Clear selected records
            toggleGroupActionForm(); // Hide the group action form
          });
        } else {
          Swal.fire(
            "Error!",
            "There was an issue updating attendance. Please try again.",
            "error"
          );
        }
      },
      error: function () {
        console.log("AJAX request failed.");
        Swal.fire("Error!", "AJAX request failed. Please try again.", "error");
      },
    });
  }

  // Set up search filter for input field

  // Function to set up filters on the select dropdowns
  function setUpSelectFilters() {
    // Program filter
    $("#kt_datatable_program_att").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "course_id");
    });

    // Year Level filter
    $("#kt_datatable_yearlvl_att").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "yearlvl");
    });

    // Initialize selectpickers (if you're using Bootstrap select or similar)
    $("#kt_datatable_program_att, #kt_datatable_yearlvl_att").selectpicker();
  }

  // Initialize select filters
  setUpSelectFilters();

  $("#kt_datatable_program_att").change(function () {
    const programs = this.selectedOptions;
    if (!programs && typeof programs !== "object") return;
    kt_datatable_program_att = Object.keys(programs).map((key) => {
      return programs[key].value;
    });
    // kada bago ng program, check kung anung mga sections
    checkSections();
  });

  $("#kt_datatable_yearlvl_att").change(function () {
    const yearlevels = this.selectedOptions;
    if (!yearlevels && typeof yearlevels !== "object") return;
    kt_datatable_yearlvl_att = Object.keys(yearlevels).map((key) => {
      return yearlevels[key].value;
    });
    // kada bago ng yearlevel, check kung anung mga sections
    checkSections();
  });

  function checkSections() {
    // If either programs or year levels are empty, disable and clear the sections
    if (
      kt_datatable_program_att.length === 0 ||
      kt_datatable_yearlvl_att.length === 0
    ) {
      $("#kt_datatable_section_att").html("").prop("disabled", true);
      return;
    }

    var dataString =
      "ajax=std_att_check_sections" +
      "&kt_datatable_program_att=" +
      btoa(kt_datatable_program_att).replace(/\=/g, "") +
      "&kt_datatable_yearlvl_att=" +
      btoa(kt_datatable_yearlvl_att).replace(/\=/g, "");

    console.log(dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        console.log("html", html);
        $("#kt_datatable_section_att").html(html).prop("disabled", false);
      },
    });
  }
  $("#kt_datatable_section_att").on("change", function () {
    // Get the selected section value and perform a search in the datatable
    datatable.search($(this).val().toLowerCase(), "section_id");
  });
});

$(document).on(
  "change",
  'input[name="switch_emp"][type="checkbox"]',
  function () {
    var emp_id = $(this).data("emp-id");
    var event_id = $(this).data("event-id");
    var status = $(this).is(":checked") ? "attended" : "absent";
    var originalStatus = $(this).prop("checked"); // Save the original state of the checkbox

    // Confirm the action with SweetAlert
    Swal.fire({
      title:
        "Mark this user as " +
        (status === "attended" ? "attended?" : "absent?"),
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `Cancel`,
    }).then((result) => {
      if (result.isConfirmed) {
        $(this).prop("disabled", true); // Disable the checkbox while processing

        var dataString = {
          ajax: "emp_attended",
          event_id: event_id,
          emp_id: emp_id,
          status: status, // Send status based on checkbox state
        };

        // Send AJAX request to update attendance
        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: dataString,
          success: function (response) {
            console.log(response);
            if (response === "success") {
              // Show success notification with SweetAlert
              Swal.fire(
                "Done!",
                "This user is marked as " + status + ".",
                "success"
              ).then(() => {
                // Dynamically update the row without reloading the page
                var row = datatable
                  .getDataSourceParam("data")
                  .find((row) => row.emp_id == emp_id);
                if (row) {
                  row.status = status; // Update the status
                  row.attendance_date =
                    status === "attended"
                      ? moment().format("MMMM D, YYYY, h:mm A")
                      : "---------"; // Update attendance date
                  // Update the table row to reflect the changes
                  datatable.updateRow(row);
                }
              });
            } else {
              // Show error notification with SweetAlert
              Swal.fire(
                "Error!",
                "There was an issue updating the status.",
                "error"
              ).then(() => {
                location.reload();
              });
            }
          },
          error: function (xhr, status, error) {
            console.error(error);
            // Show error notification if AJAX fails
            Swal.fire(
              "Error!",
              "There was an issue with the request. Please try again.",
              "error"
            );
          },
        });
      } else if (result.isDenied) {
        // Revert the checkbox to its original state if canceled
        Swal.fire("Changes are not saved", "", "info");
        $(this).prop("checked", originalStatus);
      }
    });
  }
);

$(document).ready(function () {
  // Configuration for the main datatable
  var eventID = $("#event_id").val();

  // Initialize the KTDatatable
  var datatable = $("#attendance_emp").KTDatatable({
    data: {
      type: "remote", // Load data remotely
      source: {
        read: {
          url: "ajax.php", // URL for fetching data
          method: "POST", // HTTP method
          params: {
            ajax: "attendance-emp",
            event_id: eventID, // Pass the event_id dynamically
          },
        },
      },
      pageSize: 10, // Rows per page
    },

    search: {
      input: $("#datatable_search2"),
    },
    sortable: true, // Enable sorting
    layout: {
      scroll: false, // Disable scrolling
      footer: false, // Hide footer
    },
    columns: [
      {
        field: "emp_id",
        title: `
        <label class="checkbox checkbox-inline">
											
          <input type="checkbox" id="select_all_checkbox_emp">
											<span></span>
										</label>
        `,
        sortable: false,
        width: 30,
        textAlign: "center",
        template: function (row) {
          return `
          
        <label class="checkbox checkbox-inline">
            <input type="checkbox" class="kt-checkbox_emp" data-emp-id="${row.emp_id}">
            
											<span></span>
										</label>
          `;
        },
      },

      {
        field: "emp_profilepic",
        title: "",
        width: 50,
        template: function (row) {
          return `
            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
              <img src="${row.emp_profilepic}" class="h-75 align-self-end" alt="">
            </div>`;
        },
      },
      {
        field: "emp_lname",
        title: "Full Name",
        width: 150,
        template: function (row) {
          return `
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
              ${row.emp_fname} ${row.emp_lname}
            </a>
            <span class="text-muted font-weight-bold text-muted d-block">${row.emp_kld_id}</span>`;
        },
      },
      {
        field: "emp_role",
        title: "Position",
        template: function (row) {
          return `<span class="text-muted font-weight-bold">${row.emp_role}</span>`;
        },
      },
      { field: "org_name", title: "Organization" },
      {
        field: "attendance_date",
        title: "Date",
        width: 150,
        template: function (row) {
          let status = "Absent"; // Default status
          let attendance_date = "---------"; // Default date when not attended

          // If the attendance status is "attended", display the date
          if (row.status === "attended") {
            status = "Attended";
            attendance_date = row.attendance_date
              ? moment(row.attendance_date).format("MMMM D, YYYY, h:mm A")
              : "---------"; // Format the date or use default
          }

          return `
            <span class="text-muted font-weight-bolder d-block font-size-lg">${attendance_date}</span>
          `;
        },
      },
      {
        field: "status",
        title: "Status",
        width: 200,
        template: function (row) {
          let status = "Absent"; // Default status
          let label_class = "label-light-danger"; // Default class for "Absent"

          // If the attendance status is "attended", set the appropriate class and label
          if (row.status === "attended") {
            status = "Attended";
            label_class = "label-light-primary"; // Class for "Attended"
          }

          return `
            <span class="label label-lg ${label_class} label-inline">${status}</span>
          `;
        },
      },
      {
        field: "attendance_toggle",
        title: "Action",
        width: 100,
        template: function (row) {
          // Set the checkbox checked or unchecked based on attendance status
          let isChecked = row.status === "attended" ? 'checked="checked"' : "";

          return `
              <form method="post">
                <input type="hidden" id="emp_id" name="emp_id" value="${row.emp_id}"/>
                <input type="hidden" id="event_id" name="event_id" value="${eventID}"/>
                <span class="switch switch-outline switch-icon switch-success">
                  <label>
                    <input type="checkbox" name="switch_emp" class="attended-checkbox" ${isChecked} data-emp-id="${row.emp_id}" data-event-id="${eventID}" name="select"/>
                    <span></span>
                  </label>
                </span>
              </form>
          `;
        },
      },
    ],
  });

  $(document).on("change", "#select_all_checkbox_emp", function () {
    var isChecked = $(this).is(":checked");

    // Toggle all row checkboxes based on the header checkbox
    $(".kt-checkbox_emp").prop("checked", isChecked).trigger("change");
  });

  var selectedRecords = [];
  var eventID = $("#event_id").val(); // Assuming eventID is available as a global variable

  // Event delegation for individual checkboxes
  $(document).on("change", " input[type='checkbox']", function () {
    var emp_id = $(this).data("emp-id"); // Get the student ID from the checkbox's data attribute
    if (!emp_id) {
      console.error(
        "emp_id is undefined. Ensure the checkbox has a valid data-emp-id attribute."
      );
      return;
    }

    // Check if the checkbox is checked
    if ($(this).is(":checked")) {
      if (!selectedRecords.includes(emp_id)) {
        selectedRecords.push(emp_id); // Add to selected records
      }
    } else {
      // Remove from selected records
      selectedRecords = selectedRecords.filter(function (id) {
        return id !== emp_id;
      });
    }

    // Update the selected records count display
    console.log("Selected Records:", selectedRecords);
    $("#kt_datatable_selected_records_emp").text(selectedRecords.length);

    // Toggle the visibility of the group action form
    toggleGroupActionForm();
  });

  // Function to toggle the visibility of the group action form
  function toggleGroupActionForm() {
    if (selectedRecords.length > 0) {
      $("#kt_datatable_group_action_form_emp").collapse("show");
    } else {
      $("#kt_datatable_group_action_form_emp").collapse("hide");
    }
  }

  // Handle "Present" and "Absent" actions
  $("#mark-present-emp").on("click", function () {
    updateAttendanceStatus("attended");
  });

  $("#mark-absent-emp").on("click", function () {
    updateAttendanceStatus("absent");
  });

  // Function to update the attendance status of selected records
  function updateAttendanceStatus(status) {
    console.log({
      ajax: "update-attendance-status-emp",
      event_id: eventID,
      emp_ids: selectedRecords, // Send selected student IDs
      status: status,
    });

    // Check if selectedRecords is empty before sending AJAX
    if (selectedRecords.length === 0) {
      Swal.fire(
        "No records selected!",
        "Please select students to update.",
        "warning"
      );
      return; // Exit the function if no records are selected
    }

    // Send AJAX request to update the attendance status of the selected records
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: {
        ajax: "update-attendance-status-emp",
        event_id: eventID,
        emp_ids: selectedRecords, // Pass the array of selected student IDs
        status: status,
      },
      success: function (response) {
        console.log("Response:", response);
        if (response === "success") {
          Swal.fire(
            "Success!",
            "Attendance status updated for selected students.",
            "success"
          ).then(() => {
            // Reload the datatable or refresh the page
            datatable.reload(); // Make sure `datatable` is the correct object
            $("#emp_attendance_count").text("0"); // Reset the count display
            selectedRecords = []; // Clear selected records
            toggleGroupActionForm(); // Hide the group action form
          });
        } else {
          Swal.fire(
            "Error!",
            "There was an issue updating attendance. Please try again.",
            "error"
          );
        }
      },
      error: function () {
        console.log("AJAX request failed.");
        Swal.fire("Error!", "AJAX request failed. Please try again.", "error");
      },
    });
  }

  // Set up search filter for input field
  // Function to set up filters on the select dropdowns
  function setUpSelectFilters() {
    // Program filter
    $("#kt_datatable_org").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "org_id");
    });

    // Initialize selectpickers (if you're using Bootstrap select or similar)
    $("#kt_datatable_org").selectpicker();
  }

  // Initialize select filters
  setUpSelectFilters();

  datatable.on("datatable-on-click-checkbox", function (e) {
    // datatable.checkbox() access to extension methods
    var ids = datatable.checkbox().getSelectedId();
    var count = ids.length;

    $("#kt_datatable_selected_records_emp").html(count);

    if (count > 0) {
      $("#kt_datatable_group_action_form_emp").collapse("show");
    } else {
      $("#kt_datatable_group_action_form_emp").collapse("hide");
    }
  });

  $("#kt_datatable_fetch_modal")
    .on("show.bs.modal", function (e) {
      var ids = datatable.checkbox().getSelectedId();
      var c = document.createDocumentFragment();
      for (var i = 0; i < ids.length; i++) {
        var li = document.createElement("li");
        li.setAttribute("data-id", ids[i]);
        li.innerHTML = "Selected record ID: " + ids[i];
        c.appendChild(li);
      }
      $("#kt_datatable_fetch_display").append(c);
    })
    .on("hide.bs.modal", function (e) {
      $("#kt_datatable_fetch_display").empty();
    });
});
