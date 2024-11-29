var feedbackChart = (function () {
  var _demo110 = function () {
    const apexChart = "#chart_110";
    var options = {
      series: [
        responseCounts.stronglyDisagree,
        responseCounts.disagree,
        responseCounts.neutral,
        responseCounts.agree,
        responseCounts.stronglyAgree,
      ],
      chart: {
        width: 380,
        type: "donut",
      },
      labels: [
        "Strongly Disagree",
        "Disagree",
        "Neutral",
        "Agree",
        "Strongly Agree",
      ], // Labels for the donut chart
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
      colors: [
        KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
        KTApp.getSettings()["colors"]["theme"]["base"]["info"],
        KTApp.getSettings()["colors"]["theme"]["base"]["warning"],
        KTApp.getSettings()["colors"]["theme"]["base"]["primary"],
        KTApp.getSettings()["colors"]["theme"]["base"]["success"],
      ],
    };

    var chart = new ApexCharts(document.querySelector(apexChart), options);
    chart.render();
  };

  return {
    // public functions
    init: function () {
      _demo110();
    },
  };
})();

jQuery(document).ready(function () {
  feedbackChart.init();
});
