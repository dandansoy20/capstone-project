$(document).ready(function () {
  // Configuration for the main datatable
  var dataString = { ajax: "std-fetch" }; // Parameters to send with the AJAX request

  // Initialize the KTDatatable
  var datatable = $("#my_kt_datatable").KTDatatable({
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
      {
        field: "std_email",
        title: "Email",
        template: function (row) {
          return `<span class="text-muted font-weight-bold">${row.std_kld_email}</span>`;
        },
      },
      { field: "course_acronym", title: "Program" },
      { field: "yearlvl_name", title: "Year Level" },
      { field: "section_name", title: "Section" },
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
