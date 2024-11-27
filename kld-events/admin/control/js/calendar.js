"use strict";

var KTCalendarExternalEvents = (function () {
  var initCalendar = function () {
    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("kt_calendar");

    new Draggable(containerEl, {
      itemSelector: ".fc-draggable-handle",
      eventData: function (eventEl) {
        return $(eventEl).data("event");
      },
    });

    var dataString = "ajax=calendar_init";
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (html) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: ["interaction", "dayGrid", "timeGrid", "list"],

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

          droppable: true, // this allows things to be dropped onto the calendar
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          navLinks: true,
          events: JSON.parse(html),

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
              } else if (element.find(".fc-list-item-title").lenght !== 0) {
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
        console.log(html);
      },
    });
  };

  return {
    //main function to initiate the module
    init: function () {
      initExternalEvents();
      initCalendar();
    },
  };
})();

jQuery(document).ready(function () {
  KTCalendarExternalEvents.init();
});
