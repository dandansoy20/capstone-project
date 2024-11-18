$(document).ready(function () {
  // Configuration for the main datatable
  var dataString = { ajax: "emp-fetch" }; // Parameters to send with the AJAX request

  // Initialize the KTDatatable
  var datatable = $("#my_kt_datatable_emp").KTDatatable({
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
        title: "#",
        sortable: false,
        width: 20,
        selector: {
          class: "",
        },
        textAlign: "center",
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
        field: "emp_fname",
        title: "Full Name",
        width: 200,
        template: function (row) {
          return `
            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
              ${row.emp_fname} ${row.emp_lname}
            </a>
            <span class="text-muted font-weight-bold text-muted d-block">${row.emp_kld_id}</span>`;
        },
      },
      {
        field: "emp_email",
        title: "Email",
        template: function (row) {
          return `<span class="text-muted font-weight-bold">${row.emp_kld_email}</span>`;
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
    ],
  });

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
