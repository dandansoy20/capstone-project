// Class definition
var KTBootstrapTimepicker = (function () {
  // Private functions
  var demos = function () {
    // minimum setup
    $("#kt_timepicker_1, #kt_timepicker_1_modal").timepicker();

    // minimum setup
    $("#kt_timepicker_2, #kt_timepicker_2_modal").timepicker({
      minuteStep: 1,
      defaultTime: "",
      showSeconds: true,
      showMeridian: false,
      snapToStep: true,
    });

    // default time
    $("#kt_timepicker_3, #kt_timepicker_3_modal").timepicker({
      defaultTime: "11:45:20 AM",
      minuteStep: 1,
      showSeconds: true,
      showMeridian: true,
    });

    // default time
    $("#kt_timepicker_4, #kt_timepicker_4_modal").timepicker({
      defaultTime: "10:30:20 AM",
      minuteStep: 1,
      showSeconds: true,
      showMeridian: true,
    });

    // validation state demos
    $(
      "#kt_timepicker_1_validate, #kt_timepicker_2_validate, #kt_timepicker_3_validate"
    ).timepicker({
      minuteStep: 1,
      showSeconds: true,
      showMeridian: false,
      snapToStep: true,
    });
  };

  // Function to initialize timepicker for a specific element
  var initTimepickerForElement = function (elementId) {
    $("#" + elementId).timepicker({
      defaultTime: "11:45:20 AM",
      minuteStep: 1,
      showSeconds: true,
      showMeridian: true,
    });
  };

  return {
    // public functions
    init: function () {
      demos();

      // Initialize repeater with a single add per click
      $("#add_info_agenda").repeater({
        initEmpty: false,
        defaultValues: {
          "text-input": "",
        },
        show: function () {
          // Log for debugging
          console.log("Form added");

          // Ensure no multiple adds
          if (!$(this).data("initialized")) {
            $(this).slideDown();

            // Generate a unique ID for each timepicker (agenda_tp)
            var uniqueId = "agenda_tp_" + new Date().getTime();
            $(this).find(".agenda_tp").attr("id", uniqueId);

            // Initialize timepicker for new element
            initTimepickerForElement(uniqueId);

            // Mark as initialized
            $(this).data("initialized", true);
          }
        },
        hide: function (deleteElement) {
          $(this).slideUp(deleteElement);
        },
      });

      // Initialize the first timepicker manually
      initTimepickerForElement("agenda_tp_1");
    },
  };
})();

// Document ready function
jQuery(document).ready(function () {
  KTBootstrapTimepicker.init();
});
