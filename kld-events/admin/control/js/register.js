$(document).ready(function () {
  // Initialize the KTDatatable
  var datatable = $("#kt_datatable").KTDatatable({
    // Enable sorting, pagination, and searching
    sortable: true,
    pagination: true,
    search: true,

    // Set the AJAX configuration to fetch data from PHP
    ajax: {
      url: "ajax.php", // The PHP file that returns the data
      method: "GET", // Method of request (GET, POST, etc.)
      data: function (data) {
        // Add additional parameters to the request if needed (like filters)
        var status = $("#kt_datatable_search_status").val();
        var type = $("#kt_datatable_search_type").val();

        // Append custom filters to the data being sent to the server
        data.status = status;
        data.type = type;
      },
      dataSrc: "data", // Where to find the actual data in the JSON response
    },

    // Define the columns for KTDatatable
    columns: [
      {
        field: "select",
        title: "Select",
        selector: { class: "m-checkbox--solid m-checkbox--brand" },
        width: 30,
      },
      {
        field: "std_profile",
        title: "Student",
      },
      {
        field: "std_name",
        title: "",
      },
      {
        field: "course_name",
        title: "Program",
      },
      {
        field: "section_name",
        title: "Section",
      },
    ],

    // Enable multi-row selection
    select: {
      style: "multi",
      selector: "td:first-child",
    },
  });

  // Handle record selection demo
  $("#kt_datatable").on("change", "tbody .m-checkbox", function () {
    var selectedRecords = datatable.getSelectedRecords();
    console.log("Selected Records: ", selectedRecords);
  });

  // Handle search form submit
  $(".btn-light-primary").on("click", function () {
    datatable.reload(); // Reload data based on the current filters
  });
});

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
  // Configuration for the main datatable
  var dataString = { ajax: "registered-std", event_id: $("#event_id").val() }; // Parameters to send with the AJAX request

  // Initialize the KTDatatable
  var datatable = $("#registered_std").KTDatatable({
    data: {
      type: "remote", // Load data remotely
      source: {
        read: {
          url: "ajax.php", // URL for fetching data
          method: "POST", // HTTP method
          params: dataString, // Query parameters
        },
      },
      pageSize: 10, // Rows per page
    },
    selector: {
      class: "kt-checkbox--solid",
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
        title: "#",
        sortable: false,
        width: 20,
        selector: {
          class: "",
        },
        textAlign: "center",
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
        width: 200,
        template: function (row) {
          return `
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
              ${row.std_fname} ${row.std_lname}
            </a>
            <span class="text-muted font-weight-bold text-muted d-block">${row.std_kld_id}</span>`;
        },
      },
      { field: "course_acronym", title: "Program", width: 50 },
      { field: "yearlvl_name", title: "Year Level" },
      { field: "section_name", title: "Section" },
      {
        field: "reg_date",
        title: "Date",
        width: 150,
        template: function (row) {
          let status = "Not Yet Registered";
          let reg_date = "---------";

          if (row.reg_status === "registered") {
            status = "Registered";
            reg_date = row.reg_date
              ? moment(row.reg_date).format("MMMM D, YYYY")
              : "---------";
          }

          return `
            <span class="text-muted font-weight-bolder d-block font-size-lg">${reg_date}</span>
          `;
        },
      },
      {
        field: "reg_status",
        title: "Status",
        width: 200,
        template: function (row) {
          let status = "Not Yet Registered";
          let reg_date = "--------------";

          if (row.reg_status === "registered") {
            status = "Registered";
            reg_date = row.reg_date
              ? moment(row.reg_date).format("MMMM D, YYYY")
              : "--------------";
          }

          let label_class =
            status === "Registered"
              ? "label-light-primary"
              : "label-light-danger";

          return `
            <span class="label label-lg ${label_class} label-inline">${status}</span>
          `;
        },
      },
    ],
  });

  // Set up search filter for input field

  // Function to set up filters on the select dropdowns
  function setUpSelectFilters() {
    // Program filter
    $("#kt_datatable_program").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "course_id");
    });

    // Year Level filter
    $("#kt_datatable_yearlvl").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "yearlvl_id");
    });

    // Initialize selectpickers (if you're using Bootstrap select or similar)
    $("#kt_datatable_program, #kt_datatable_yearlvl").selectpicker();
  }

  // Initialize select filters
  setUpSelectFilters();

  $("#kt_datatable_program").change(function () {
    const programs = this.selectedOptions;
    if (!programs && typeof programs !== "object") return;
    kt_datatable_program = Object.keys(programs).map((key) => {
      return programs[key].value;
    });
    // kada bago ng program, check kung anung mga sections
    checkSections();
  });

  $("#kt_datatable_yearlvl").change(function () {
    const yearlevels = this.selectedOptions;
    if (!yearlevels && typeof yearlevels !== "object") return;
    kt_datatable_yearlvl = Object.keys(yearlevels).map((key) => {
      return yearlevels[key].value;
    });
    // kada bago ng yearlevel, check kung anung mga sections
    checkSections();
  });

  function checkSections() {
    // If either programs or year levels are empty, disable and clear the sections
    if (
      kt_datatable_program.length === 0 ||
      kt_datatable_yearlvl.length === 0
    ) {
      $("#kt_datatable_section").html("").prop("disabled", true);
      return;
    }

    var dataString =
      "ajax=std_check_sections" +
      "&kt_datatable_program=" +
      btoa(kt_datatable_program).replace(/\=/g, "") +
      "&kt_datatable_yearlvl=" +
      btoa(kt_datatable_yearlvl).replace(/\=/g, "");

    console.log(dataString);

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        console.log("html", html);
        $("#kt_datatable_section").html(html).prop("disabled", false);
      },
    });
  }
  $("#kt_datatable_section").on("change", function () {
    // Get the selected section value and perform a search in the datatable
    datatable.search($(this).val().toLowerCase(), "section_id");
  });

  // enable extension
  options.extensions = {
    // boolean or object (extension options)
    checkbox: true,
  };

  datatable.on("datatable-on-click-checkbox", function (e) {
    // datatable.checkbox() access to extension methods
    var ids = datatable.checkbox().getSelectedId();
    var count = ids.length;

    $("#kt_datatable_selected_records").html(count);

    if (count > 0) {
      $("#kt_datatable_group_action_form").collapse("show");
    } else {
      $("#kt_datatable_group_action_form").collapse("hide");
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
