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
        width: 30,
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
      datatable.search($(this).val().toLowerCase(), "yearlvl");
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
      "ajax=std_reg_check_sections" +
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
});
