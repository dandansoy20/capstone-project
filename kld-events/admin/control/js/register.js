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
