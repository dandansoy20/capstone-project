// Class definition
var KTBootstrapDatetimepicker = (function () {
  // Private functions
  var baseDemos = function () {
    // Initialize the first datetimepicker
    $("#kt_datetimepicker_1").datetimepicker();

    // Other demos
    $("#kt_datetimepicker_2").datetimepicker({ locale: "de" });
    $("#kt_datetimepicker_3").datetimepicker({ format: "L" });
    $("#kt_datetimepicker_4").datetimepicker({ format: "LT" });
    $("#kt_datetimepicker_5").datetimepicker();
    $("#kt_datetimepicker_6").datetimepicker({
      defaultDate: "11/1/2020",
      disabledDates: [
        moment("12/25/2020"),
        new Date(2020, 11 - 1, 21),
        "11/22/2022 00:53",
      ],
    });
    $("#kt_datetimepicker_7_1").datetimepicker();
    $("#kt_datetimepicker_7_2").datetimepicker({ useCurrent: false });

    $("#kt_datetimepicker_7_1").on("change.datetimepicker", function (e) {
      $("#kt_datetimepicker_7_2").datetimepicker("minDate", e.date);
    });
    $("#kt_datetimepicker_7_2").on("change.datetimepicker", function (e) {
      $("#kt_datetimepicker_7_1").datetimepicker("maxDate", e.date);
    });
    $("#kt_datetimepicker_8").datetimepicker({ inline: true });
  };

  var modalDemos = function () {
    $("#kt_datetimepicker_9").datetimepicker();
    $("#kt_datetimepicker_10").datetimepicker({ locale: "de" });
    $("#kt_datetimepicker_11").datetimepicker({ format: "L" });
  };

  var validationDemos = function () {
    $("#kt_datetimepicker_12").datetimepicker();
    $("#kt_datetimepicker_13").datetimepicker();
  };

  var initDynamicDatetimepicker = function (element) {
    $(element).datetimepicker(); // Initialize datetimepicker for dynamic elements
  };

  return {
    // Public functions
    init: function () {
      baseDemos();
      modalDemos();
      validationDemos();

      // Initialize the repeater with a single add per click
      $("#add_info_todo").repeater({
        initEmpty: false,
        defaultValues: {
          "text-input": "",
        },
        show: function () {
          // Log for debugging
          console.log("Form added");

          // Generate a unique ID for the new datetimepicker
          var uniqueId = "kt_datetimepicker_" + new Date().getTime();

          // Update the ID and data-target attributes for the new datetimepicker
          $(this)
            .find(".datetimepicker-input")
            .attr("id", uniqueId)
            .attr("data-target", "#" + uniqueId);

          $(this)
            .find(".input-group.date")
            .attr("id", "input-group_" + uniqueId)
            .attr("data-target", "#" + uniqueId);

          $(this)
            .find(".input-group-append")
            .attr("data-target", "#" + uniqueId);

          // Initialize datetimepicker for the new element
          initDynamicDatetimepicker("#" + uniqueId);

          // Slide down the newly added form
          $(this).slideDown();
        },
        hide: function (deleteElement) {
          $(this).slideUp(deleteElement);
        },
      });
    },
  };
})();

// Document ready function
jQuery(document).ready(function () {
  KTBootstrapDatetimepicker.init();
});
