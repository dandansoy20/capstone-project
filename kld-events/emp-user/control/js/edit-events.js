// Demo 6
$("#kt_datetimepicker_7_11").datetimepicker({
  defaultDate: eventStartDate,
});
// Demo 6
if (eventEndDate === "1970-01-01 08:00:00") {
  $("#kt_datetimepicker_7_21").datetimepicker({
    defaultDate: moment(),
  });
} else {
  $("#kt_datetimepicker_7_21").datetimepicker({
    defaultDate: eventEndDate,
  });
}

$(document).ready(function () {
  // Initialize the disabled dates when the page loads based on the selected venue
  initializeDisabledDatesForVenue();

  // Bind the change event to update the disabled dates when the venue is changed
  $("#edit_venue_name").change(function () {
    const venueId = $(this).val();
    // Fetch and update the disabled dates based on the selected venue
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: { venue_id: venueId, ajax: "venue_name" },
      success: function (response) {
        console.log("AJAX Response:", response); // Log response for debugging
        const disabledDates = JSON.parse(response).map((date) =>
          moment(date, "MM/DD/YYYY")
        );
        initializeDateTimePicker("#kt_datetimepicker_7_11", disabledDates);
        initializeDateTimePicker("#kt_datetimepicker_7_2", disabledDates);
      },
      error: function () {
        console.error("Failed to fetch disabled dates.");
      },
    });
  });

  // Function to initialize disabled dates for the selected venue on page load
  function initializeDisabledDatesForVenue() {
    const venueId = $("#edit_venue_name").val(); // Get the selected venue ID
    if (venueId) {
      $.ajax({
        url: "ajax.php",
        method: "POST",
        data: { venue_id: venueId, ajax: "venue_name" },
        success: function (response) {
          console.log("AJAX Response on page load:", response); // Log response for debugging
          const disabledDates = JSON.parse(response).map((date) =>
            moment(date, "MM/DD/YYYY")
          );
          initializeDateTimePicker("#kt_datetimepicker_7_11", disabledDates);
          initializeDateTimePicker("#kt_datetimepicker_7_21", disabledDates);
        },
        error: function () {
          console.error("Failed to fetch disabled dates on page load.");
        },
      });
    }
  }

  // Function to initialize datetime picker with disabled dates
  function initializeDateTimePicker(pickerId, disabledDates) {
    $(pickerId).datetimepicker("destroy"); // Destroy any existing instance to refresh
    $(pickerId).datetimepicker({
      format: "MM/DD/YYYY HH:mm",
      disabledDates: disabledDates, // Pass the formatted moment dates here
      useCurrent: false,
    });
  }
});
function checkSections() {
  // If either programs or year levels are empty, disable and clear the sections
  if (selectedPrograms.length === 0 || selectedYearLevels.length === 0) {
    $("#kt_select2_3").html("").prop("disabled", true);
    return;
  }

  var dataString =
    "ajax=add_event_check_sections" +
    "&selectedPrograms=" +
    btoa(selectedPrograms).replace(/\=/g, "") +
    "&selectedYearLevels=" +
    btoa(selectedYearLevels).replace(/\=/g, "");

  console.log(dataString);

  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: dataString,
    cache: false,
    success: function (html) {
      console.log("html", html);

      // Update the sections dropdown with the response data
      $("#kt_select2_3").html(html).prop("disabled", false);

      // Optionally, you can trigger the selection of previously selected sections here
      // Assuming that selectedSections is an array of previously selected section IDs
      if (Array.isArray(selectedSections) && selectedSections.length > 0) {
        selectedSections.forEach(function (sectionId) {
          $("#kt_select2_3")
            .find(`option[value="${sectionId}"]`)
            .prop("selected", true);
        });
      }
    },
  });
}

// Function to initialize form visibility based on the checkbox state
function initializeFormVisibility() {
  var toggleCheckbox = document.getElementById("AlltoggleForms");
  var formContainer = document.getElementById("formContainer");

  // Set the form container display based on the checkbox state
  formContainer.style.display = toggleCheckbox.checked ? "none" : "block";

  // Initialize visibility for other form sections based on their checkbox states
  var toggleAllOrganization = document.getElementById("toggleAllOrganization");
  var selectOrganizationContainer = document.getElementById(
    "select_organization_container"
  );
  selectOrganizationContainer.style.display = toggleAllOrganization.checked
    ? "none"
    : "flex";

  var toggleAllSections = document.getElementById("toggleAllSections");
  var selectSectionsContainer = document.getElementById(
    "select_sections_container"
  );
  selectSectionsContainer.style.display = toggleAllSections.checked
    ? "none"
    : "flex";

  var toggleCap = document.getElementById("toggleCap");
  var formCapacity = document.getElementById("formCapacity");
  var formCapacityText = document.getElementById("formCapacityText");
  if (toggleCap.checked) {
    formCapacity.style.display = "flex";
    formCapacityText.style.display = "block";
  } else {
    formCapacity.style.display = "none";
    formCapacityText.style.display = "none";
  }
}

// Call the function to initialize visibility when the page loads
initializeFormVisibility();

// Event listeners to toggle visibility when checkbox state changes
document
  .getElementById("toggleAllOrganization")
  .addEventListener("change", function () {
    var formContainer = document.getElementById(
      "select_organization_container"
    );
    formContainer.style.display = this.checked ? "none" : "flex";
  });

document
  .getElementById("toggleAllSections")
  .addEventListener("change", function () {
    var formContainer = document.getElementById("select_sections_container");
    formContainer.style.display = this.checked ? "none" : "flex";
  });

document.getElementById("toggleCap").addEventListener("change", function () {
  var formCapacity = document.getElementById("formCapacity");
  var formCapacityText = document.getElementById("formCapacityText");
  if (this.checked) {
    formCapacity.style.display = "flex";
    formCapacityText.style.display = "block";
  } else {
    formCapacity.style.display = "none";
    formCapacityText.style.display = "none";
  }
});

//////////////////////////

$("#edit_event_submit").click(function () {
  // Run validation before proceeding
  if (!validateForm()) {
    return; // Stop if validation fails
  }

  // Collect the event type from the radio buttons
  const eventType = $("input[name='eventType']:checked").val(); // Get the selected event type (either 'virtual' or 'inPerson')

  // Ensure the eventType is valid
  if (eventType !== "virtual" && eventType !== "inPerson") {
    console.error("Invalid event type selected!");
    return; // Exit if the event type is invalid
  }

  // Construct dataString with URL encoding
  let dataString =
    "ajax=add_event" +
    "&eventType=" +
    encodeURIComponent(eventType) + // Use the captured eventType
    "&venue_id=" +
    encodeURIComponent($("#edit_venue_name").val()) +
    "&event_start_date=" +
    encodeURIComponent($("#event_start_date").val()) +
    "&event_end_date=" +
    encodeURIComponent($("#event_end_date").val()) +
    "&event_title=" +
    encodeURIComponent($("#event_title").val()) +
    "&event_description=" +
    encodeURIComponent($("#event_description").val()) +
    "&event_category=" +
    encodeURIComponent($("#event_category").val()) +
    "&event_organization=" +
    encodeURIComponent($("#event_organization").val()) +
    "&proposal_letter=" +
    encodeURIComponent($("#kt_maxlength_5").val());

  // Include capacity if the toggle is checked
  if ($("#toggleCap").is(":checked")) {
    const attendeeCount = $("#kt_nouislider_1_input").val(); // Get the value from the input field
    dataString += "&capacity=" + encodeURIComponent(attendeeCount); // Append capacity to dataString
  }

  // Collect selected organizers
  const organizers = [];
  $("#org_repeater .another-org-select").each(function () {
    if ($(this).val()) {
      organizers.push($(this).val()); // Get the selected organizer ID
    }
  });

  // Log the collected organizers
  console.log("Organizers selected:", organizers);

  // Collect selected admins
  const admins = [];

  // First, add the admin ID from the hidden input
  const adminId = $("#admin_id").val(); // Get the admin ID
  if (adminId) {
    admins.push(adminId); // Push the admin ID first
  }

  // Then, collect the selected admins from the dropdown
  $("#admin_repeater .admin-select").each(function () {
    if ($(this).val()) {
      admins.push($(this).val()); // Get the selected admin ID
    }
  });

  // Log the collected admins
  console.log("Admins selected:", admins);

  // Add organizers and admins to dataString
  dataString +=
    "&event_organizers=" + encodeURIComponent(JSON.stringify(organizers));
  dataString += "&event_admins=" + encodeURIComponent(JSON.stringify(admins));
  // Collect selected attendees

  const attendees = {
    select_all_kld_members: $("#toggleForms").is(":checked"),
    course_ids: $("#kt_select2_11").val() || [], // get selected course IDs
    yearlvl_ids: $("#yrlevel").val() || [], // get selected year levels
    section_ids: $("#kt_select2_3").val() || [], // get selected section IDs
    org_ids: $("#kt_select_2_4").val() || [], // get selected organization IDs
  };

  // Determine values to send based on selections
  if (attendees.select_all_kld_members) {
    attendees.course_ids = null; // Use null instead of empty string
    attendees.yearlvl_ids = null; // Use null instead of empty string
    attendees.section_ids = null; // Use null instead of empty string
    attendees.org_ids = null; // Use null instead of empty string
  } else {
    if ($("#toggleAllSections").is(":checked")) {
      attendees.section_ids = null; // Use null for "All Sections"
    }
    if ($("#toggleAllOrganization").is(":checked")) {
      attendees.org_ids = null; // Use null for "All Organizations"
    }
  }

  // Add the attendees information to the dataString
  dataString +=
    "&course_ids=" + encodeURIComponent(JSON.stringify(attendees.course_ids));
  dataString +=
    "&yearlvl_ids=" + encodeURIComponent(JSON.stringify(attendees.yearlvl_ids));
  dataString +=
    "&section_ids=" + encodeURIComponent(JSON.stringify(attendees.section_ids));
  dataString +=
    "&org_ids=" + encodeURIComponent(JSON.stringify(attendees.org_ids));

  // Collect selected organizers and admins...

  // (Your existing code for collecting organizers and admins)

  // Check if a file was uploaded in Dropzone
  const dropzoneInstance = $("#kt_dropzone_1").get(0).dropzone;
  if (dropzoneInstance && dropzoneInstance.files.length > 0) {
    dataString +=
      "&event_poster=" +
      encodeURIComponent(btoa(dropzoneInstance.files[0].dataURL));
  } else {
    Swal.fire("Please upload an event poster!", "", "warning");
    return;
  }

  console.log("Data sent to server: ", dataString);

  // AJAX call to submit the data
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: dataString,
    cache: false,
    success: function (response) {
      const data = JSON.parse(response); // Parse the JSON response
      console.log("Server response:", data); // Log the entire response for debugging

      if (data.status === "success") {
        Swal.fire(
          "Event created successfully!",
          "Redirecting to your event...",
          "success"
        );
        setTimeout(function () {
          window.open(
            "index.php?page=pending-view&event_id=" + data.event_id,
            "_self"
          );
        }, 5000); // 5 seconds
      } else {
        Swal.fire("Something went wrong: " + data.message, "", "error");
      }
    },
  });
});
