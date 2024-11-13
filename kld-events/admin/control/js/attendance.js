////////////
$(document).ready(function () {
  const typeSelect = $("#kt_datatable_search_status");
  const studentFields = $("#student-fields");
  const employeeFields = $("#employee-fields");
  const studentTable = $("#student-table");
  const employeeTable = $("#employee-table");
  const adminTable = $("#admin-table");

  function updateFields(selectedType) {
    studentFields.addClass("d-none");
    employeeFields.addClass("d-none");

    if (selectedType === "std") {
      studentFields.removeClass("d-none");
    } else if (selectedType === "emp") {
      employeeFields.removeClass("d-none");
    }
  }

  function updateTables(selectedType) {
    studentTable.addClass("d-none");
    employeeTable.addClass("d-none");
    adminTable.addClass("d-none");

    if (selectedType === "std") {
      studentTable.removeClass("d-none");
    } else if (selectedType === "emp") {
      employeeTable.removeClass("d-none");
    } else if (selectedType === "adm") {
      adminTable.removeClass("d-none");
    }
  }

  function manageCheckboxes() {
    const checkboxes = $(
      `${getVisibleTable()} tbody input[type="checkbox"]:not(.switch input[type="checkbox"])`
    );
    const mainCheckbox = $(`${getVisibleTable()} thead input[type="checkbox"]`);
    let selectedCount = 0;

    checkboxes.each(function () {
      $(this).on("change", function () {
        this.checked ? selectedCount++ : selectedCount--;
        updateSelectedCount(selectedCount);
      });
    });

    mainCheckbox.on("change", function () {
      const isChecked = this.checked;
      checkboxes.each(function () {
        this.checked = isChecked;
        selectedCount = isChecked ? checkboxes.length : 0;
      });
      updateSelectedCount(selectedCount);
    });
  }

  function getVisibleTable() {
    if (!studentTable.hasClass("d-none")) return "#student-table";
    if (!employeeTable.hasClass("d-none")) return "#employee-table";
    if (!adminTable.hasClass("d-none")) return "#admin-table";
  }

  function updateSelectedCount(selectedCount) {
    $("#kt_datatable_selected_records").text(selectedCount);
    if (selectedCount > 0) {
      $("#kt_datatable_group_action_form").addClass("show");
    } else {
      $("#kt_datatable_group_action_form").removeClass("show");
    }
  }

  updateFields(typeSelect.val());
  updateTables(typeSelect.val());
  manageCheckboxes();

  typeSelect.on("change", function () {
    updateFields(this.value);
    updateTables(this.value);
    manageCheckboxes();
  });
});

$(document).ready(function () {
  const switches = $('.attendance_switch input[type="checkbox"]');
  switches.each(function () {
    $(this).on("change", function () {
      const isChecked = this.checked;
      const studentId = this.value;
      Swal.fire({
        title: "Are you sure?",
        text: isChecked
          ? "Mark this user as Registered?"
          : "Mark this user as Not Registered?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.value) {
          console.log(`Student ID: ${studentId}, Present: ${isChecked}`);
          Swal.fire("Updated!", "Registration has been updated.", "success");
        } else {
          this.checked = !isChecked;
        }
      });
    });
  });
});

$(".attended-checkbox").change(function () {
  var std_id = $(this).data("std-id");
  var event_id = $(this).data("event-id");
  var status = $(this).is(":checked") ? "attended" : "absent";
  var originalStatus = $(this).prop("checked"); // Save the original state of the checkbox

  Swal.fire({
    title:
      "Mark this user as " + (status == "attended" ? "attended?" : "absent?"),
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

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        success: function (response) {
          console.log(response);
          if (response === "success") {
            Swal.fire(
              "Done!",
              "This user is marked as " + status + ".",
              "success"
            ).then(() => {
              var event_id = $("#event_id").val();
              window.open(
                `?page=attendance-view&event_id=${event_id}`,
                "_self"
              );
            });
          } else {
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
        },
      });
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
      $(this).prop("checked", originalStatus); // Revert the checkbox to its original state if canceled
    }
  });
});

$(document).ready(function () {
  // When the "Select All" checkbox is clicked
  $('th input[type="checkbox"]').on("change", function () {
    // Get the "checked" status of the "Select All" checkbox
    var isChecked = $(this).is(":checked");

    // Check or uncheck all checkboxes in the table based on the "Select All" status
    $('td input[type="checkbox"]').prop("checked", isChecked);

    // For debugging, you can log the state
    console.log("Select All status: " + isChecked);
  });

  // Optional: Add a listener to log the value of each checkbox when clicked
  $('td input[type="checkbox"]').on("change", function () {
    var studentId = $(this).val();
    console.log(
      "Student ID: " + studentId + ", Checked: " + $(this).is(":checked")
    );
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Function to handle fetching sections
  function fetchSections() {
    // Retrieve selected program and year level values
    const selectedPrograms = Array.from(
      document.querySelectorAll("#kt_datatable_search_program option:checked")
    ).map((option) => option.value);
    const selectedYearLevels = Array.from(
      document.querySelectorAll("#kt_datatable_search_year option:checked")
    ).map((option) => option.value);

    // Prepare the data to be sent
    const formData = new FormData();
    formData.append("action", "attendance_check_sections");
    formData.append("selectedPrograms", btoa(selectedPrograms.join(","))); // Base64 encode
    formData.append("selectedYearLevels", btoa(selectedYearLevels.join(","))); // Base64 encode

    // Make the AJAX request using fetch
    fetch("ajax.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json()) // Parse the response as JSON
      .then((data) => {
        const sectionSelect = document.getElementById(
          "kt_datatable_search_section"
        );
        sectionSelect.innerHTML = ""; // Clear previous options

        if (data.status === 1 && data.sections.length > 0) {
          // Populate the select element with new options
          data.sections.forEach((section) => {
            const option = document.createElement("option");
            option.value = section.section_id;
            option.textContent = section.section_name;
            sectionSelect.appendChild(option);
          });
        } else {
          // If no sections are available, add a default option
          const option = document.createElement("option");
          option.value = "";
          option.textContent = "No sections available";
          sectionSelect.appendChild(option);
        }
      })
      .catch((error) => {
        console.error("Error fetching sections:", error);
      });
  }

  // Event listeners for the dropdowns
  document
    .getElementById("kt_datatable_search_program")
    .addEventListener("change", fetchSections);
  document
    .getElementById("kt_datatable_search_year")
    .addEventListener("change", fetchSections);
});
