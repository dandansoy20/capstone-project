var KTCalendarBasic = (function () {
  return {
    // Main function to initiate the module
    init: function () {
      var todayDate = moment().startOf("day");
      var YM = todayDate.format("YYYY-MM");
      var TODAY = todayDate.format("YYYY-MM-DD");

      var calendarEl = document.getElementById("kt_calendar");
      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
        themeSystem: "bootstrap",
        isRTL: KTUtil.isRTL(),
        header: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio
        nowIndicator: true,
        now: TODAY + "T09:25:00", // just for demo
        views: {
          dayGridMonth: { buttonText: "month" },
          timeGridWeek: { buttonText: "week" },
          timeGridDay: { buttonText: "day" },
        },
        defaultView: "dayGridMonth",
        defaultDate: TODAY,
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        navLinks: true,

        // Fetch events using POST request

        events: function (fetchInfo, successCallback, failureCallback) {
          var dataString =
            "ajax=venue_calendar" +
            "&venue_id=" +
            $("input[name='venue_id']").val();
          console.log($("#venue_id").val()); // or $("input[name='venue_id']").val() if using Solution 2

          $.ajax({
            url: "ajax.php", // Your PHP script to fetch events
            type: "POST",
            data: dataString,
            dataType: "json",
            success: function (response) {
              // Pass the event data to the FullCalendar
              successCallback(response);
            },
            error: function () {
              failureCallback();
            },
          });
        },

        eventRender: function (info) {
          var element = $(info.el);
          if (
            info.event.extendedProps &&
            info.event.extendedProps.description
          ) {
            if (element.hasClass("fc-day-grid-event")) {
              element.data("content", info.event.extendedProps.description);
              element.data("placement", "top");
              KTApp.initPopover(element);
            } else if (element.hasClass("fc-time-grid-event")) {
              element
                .find(".fc-title")
                .append(
                  '<div class="fc-description">' +
                    info.event.extendedProps.description +
                    "</div>"
                );
            } else if (element.find(".fc-list-item-title").length !== 0) {
              element
                .find(".fc-list-item-title")
                .append(
                  '<div class="fc-description">' +
                    info.event.extendedProps.description +
                    "</div>"
                );
            }
          }
        },
      });

      calendar.render();
    },
  };
})();

jQuery(document).ready(function () {
  KTCalendarBasic.init();
});
