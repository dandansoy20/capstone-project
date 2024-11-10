// constant vars
let selectedPrograms = [];
let selectedYearLevels = [];
//On triggers
$("#event_next_button").click(function () {
  $("#review_venue").text($("#venue_name").find(":selected").text());
  $("#review_date").text(
    $("#event_start_date").val() + " - " + $("#event_end_date").val()
  );
  $("#review_title").text($("#event_title").val());
  $("#review_description").text($("#event_description").val());
  $("#review_category").text($("#event_category").find(":selected").text());
  $("#review_organizer").text($("#event_organizer").find(":selected").text());
});

function imagefileinsert(e) {
  var string = $(e).prop("files")[0];
  var file = new FileReader();
  file.readAsDataURL(string);
  //$(file).ready(function (){
  //});
  file.addEventListener(
    "load",
    function () {
      $(e)[0].outerHTML =
        '<img src="' + file.result + '" contenteditable="true" />';
      e_editmode($("#e_editor_editbtn"), "1");
    },
    false
  );
}

// Function to validate the form
function validateForm() {
  const eventType = $("input[name='eventType']:checked").val();

  // If 'inPerson' is selected, ensure a venue is selected
  if (eventType === "inPerson" && $("#venue_name").val() == "") {
    Swal.fire("Please select a venue!", "Please try again!", "error");
    return false;
  }

  // Add date validity check
  const startDate = new Date($("#event_start_date").val());
  const endDate = new Date($("#event_end_date").val());
  if (startDate >= endDate) {
    Swal.fire(
      "End date must be after the start date!",
      "Please try again!",
      "error"
    );
    return false;
  }

  return true; // Return true if all checks pass
}

// Handler for event submission
$("#event_submit").click(function () {
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
    encodeURIComponent($("#venue_name").val()) +
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
    encodeURIComponent($("#kt_summernote_1").summernote("code"));

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
  const adminId = $("#org_id").val(); // Get the admin ID
  if (adminId) {
    organizers.push(adminId); // Push the admin ID first
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

// Handler for event next button
$("#event_next_button").click(function () {
  // Run validation before proceeding
  if (!validateForm()) {
    Swal.fire(
      "AJAX request failed",
      "Please check your connection and try again.",
      "error"
    );
    return; // Stop if validation fails
  }

  // Proceed to the next step of the wizard
  _wizard.goNext(); // Make sure _wizard is defined globally or adjust accordingly
});

$("#kt_dropzone_1").dropzone({
  url: "/",
  paramName: "file",
  maxFiles: 1,
  maxFilesize: 10,
});

$("#kt_select2_11").change(function () {
  const programs = this.selectedOptions;
  if (!programs && typeof programs !== "object") return;
  selectedPrograms = Object.keys(programs).map((key) => {
    return programs[key].value;
  });
  // kada bago ng program, check kung anung mga sections
  checkSections();
});

$("#yrlevel").change(function () {
  const yearlevels = this.selectedOptions;
  if (!yearlevels && typeof yearlevels !== "object") return;
  selectedYearLevels = Object.keys(yearlevels).map((key) => {
    return yearlevels[key].value;
  });
  // kada bago ng yearlevel, check kung anung mga sections
  checkSections();
});

////venue disabler
$(document).ready(function () {
  $("#venue_name").change(function () {
    const venueId = $(this).val();

    // Fetch disabled dates for the selected venue
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: { venue_id: venueId, ajax: "venue_name" },
      success: function (response) {
        console.log("AJAX Response:", response); // Log response for debugging

        // Parse and format each date in response to 'moment' format
        const disabledDates = JSON.parse(response).map((date) =>
          moment(date, "MM/DD/YYYY")
        );
        initializeDateTimePicker("#kt_datetimepicker_7_1", disabledDates);
        initializeDateTimePicker("#kt_datetimepicker_7_2", disabledDates);
      },
      error: function () {
        console.error("Failed to fetch disabled dates.");
      },
    });
  });
});

function initializeDateTimePicker(pickerId, disabledDates) {
  $(pickerId).datetimepicker("destroy"); // Destroy any existing instance to refresh
  $(pickerId).datetimepicker({
    format: "MM/DD/YYYY HH:mm",
    disabledDates: disabledDates, // Pass formatted moment dates here
    useCurrent: false,
  });
}

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
      $("#kt_select2_3").html(html).prop("disabled", false);
    },
  });
}

$("#event_preview").click(function () {
  debugger;
  var dataString =
    "ajax=preview_event" +
    "&venue_name=" +
    $("#venue_name").val() +
    "&event_start_date=" +
    $("#event_start_date").val() +
    "&event_end_date=" +
    $("#event_end_date").val() +
    "&event_title=" +
    $("#event_title").text() +
    "&event_organization=" +
    $("#event_organization").val() +
    "&inPerson_radio=" +
    $("#inPerson_radio").val() +
    "&virtual_radio=" +
    $("#virtual_radio").val() +
    "&toggleForms=" +
    $("#toggleForms").val() +
    "&kt_select2_11=" +
    $("#kt_select2_11").val() +
    "&toggleAllSections=" +
    $("#toggleAllSections").val() +
    "&kt_select2_3=" +
    $("#kt_select2_3").val() +
    "&yrlevel=" +
    $("#yrlevel").val() +
    "&toggleAllOrganization=" +
    $("#toggleAllOrganization").val() +
    "&kt_select_2_4=" +
    $("#kt_select_2_4").val() +
    "&toggleCap=" +
    $("#toggleCap").val() +
    "&kt_nouislider_1_input=" +
    $("#kt_nouislider_1_input").val() +
    "&kt_dropzone_1=" +
    $("#kt_dropzone_1").val() +
    "&kt_maxlength_5=" +
    $("#kt_maxlength_5").val() +
    "&event_description=" +
    $("#event_description").text() +
    "&event_category=" +
    $("#event_category").val() +
    "&event_organizer=" +
    $("#event_organizer").val() +
    "&event_poster=" +
    btoa($("#kt_dropzone_1").prop("dropzone").files[0].dataURL);
  console.log(dataString);
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: dataString,
    cache: false,
    success: function (html) {
      switch (html) {
        case "1":
          break;
        case "2":
          alert("Not saved!");
          break;
        default:
          alert("Something went wrong, please try again.");
          console.log(html);
      }
    },
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var demo8 = function () {
    $("#admin_repeater").repeater({
      initEmpty: false,
      defaultValues: {
        "text-input": "foo",
      },
      show: function () {
        $(this).slideDown();
        updateOptions(adminRepeater, ".admin-select", adminAddButton);
      },
      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
        setTimeout(
          () => updateOptions(adminRepeater, ".admin-select", adminAddButton),
          100
        );
      },
    });
  };

  var demo9 = function () {
    $("#org_repeater").repeater({
      initEmpty: false,
      defaultValues: {
        "text-input": "foo",
      },
      show: function () {
        $(this).slideDown();
        updateOptions(orgRepeater, ".another-org-select", orgAddButton);
      },
      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
        setTimeout(
          () => updateOptions(orgRepeater, ".another-org-select", orgAddButton),
          100
        );
      },
    });
  };

  const adminRepeater = document.querySelector(
    "#admin_repeater [data-repeater-list]"
  );
  const adminAddButton = document.querySelector(
    "#admin_repeater [data-repeater-create]"
  );
  const orgRepeater = document.querySelector(
    "#org_repeater [data-repeater-list]"
  );
  const orgAddButton = document.querySelector(
    "#org_repeater [data-repeater-create]"
  );

  function updateOptions(repeater, selectClass, addButton) {
    const selectedValues = Array.from(repeater.querySelectorAll(selectClass))
      .map((select) => select.value)
      .filter((value) => value !== "");

    repeater.querySelectorAll(selectClass).forEach((select) => {
      const currentValue = select.value;
      select.querySelectorAll("option").forEach((option) => {
        option.style.display =
          !selectedValues.includes(option.value) ||
          option.value === currentValue
            ? "block"
            : "none";
      });
    });

    const availableOptions = Array.from(
      repeater
        .querySelector(`${selectClass}:last-of-type`)
        .querySelectorAll("option")
    ).filter(
      (option) => option.style.display !== "none" && option.value !== ""
    );

    addButton.style.display = availableOptions.length <= 1 ? "none" : "block";
  }

  function updateInput(selectElement, inputClass) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const input = selectElement
      .closest("[data-repeater-item]")
      .querySelector(inputClass);
    input.value =
      selectedOption.getAttribute("data-role") ||
      selectedOption.getAttribute("data-org");
  }

  function setupRepeater(repeater, selectClass, addButton, inputClass) {
    repeater.addEventListener("change", function (event) {
      if (event.target.classList.contains(selectClass.slice(1))) {
        updateOptions(repeater, selectClass, addButton);
        updateInput(event.target, inputClass);
      }
    });

    repeater.addEventListener("click", function (event) {
      if (event.target.closest("[data-repeater-delete]")) {
        setTimeout(() => updateOptions(repeater, selectClass, addButton), 100);
      }
    });

    addButton.addEventListener("click", function () {
      setTimeout(() => updateOptions(repeater, selectClass, addButton), 100);
    });

    updateOptions(repeater, selectClass, addButton);
  }

  setupRepeater(adminRepeater, ".admin-select", adminAddButton, ".admin-role");
  setupRepeater(
    orgRepeater,
    ".another-org-select",
    orgAddButton,
    ".another-org-name"
  );

  demo8();
  demo9();
});

document.getElementById("toggleForms").addEventListener("change", function () {
  var formContainer = document.getElementById("formContainer");
  formContainer.style.display = this.checked ? "none" : "block";
});

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

var demo1 = function () {
  // init slider
  var slider = document.getElementById("kt_nouislider_1");

  noUiSlider.create(slider, {
    start: [2],
    step: 2,
    range: {
      min: [2],
      max: [5000],
    },
    format: wNumb({
      decimals: 0,
    }),
  });

  // init slider input
  var sliderInput = document.getElementById("kt_nouislider_1_input");

  slider.noUiSlider.on("update", function (values, handle) {
    sliderInput.value = values[handle];
  });

  sliderInput.addEventListener("change", function () {
    slider.noUiSlider.set(this.value);
  });
};
