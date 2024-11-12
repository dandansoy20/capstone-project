// Class definition
var KTFormRepeater = (function () {
  // Private functions

  var demo1 = function () {
    $("#kt_repeater_1").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };

  var demo2 = function () {
    $("#kt_repeater_2").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        if (confirm("Are you sure you want to delete this element?")) {
          $(this).slideUp(deleteElement);
        }
      },
    });
  };

  var demo3 = function () {
    $("#kt_repeater_3").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        if (confirm("Are you sure you want to delete this element?")) {
          $(this).slideUp(deleteElement);
        }
      },
    });
  };

  var demo4 = function () {
    $("#kt_repeater_4").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };

  var demo5 = function () {
    $("#kt_repeater_5").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };

  var demo6 = function () {
    $("#kt_repeater_6").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };
  var demo7 = function () {
    // Initialize the form repeater
    $("#add_info_content").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };

  var demo8 = function () {
    $("#admin_repeater").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };
  var demo9 = function () {
    $("#org_repeater").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });
  };

  // var demo1 = function () {
  //   $("#add_info_todo").repeater({
  //     initEmpty: false,

  //     defaultValues: {
  //       "text-input": "foo",
  //     },

  //     show: function () {
  //       $(this).slideDown();
  //     },

  //     hide: function (deleteElement) {
  //       $(this).slideUp(deleteElement);
  //     },
  //   });
  // };

  return {
    // public functions
    init: function () {
      demo1();
      demo2();
      demo3();
      demo4();
      demo5();
      demo6();
      demo7();
    },
  };
})();

jQuery(document).ready(function () {
  KTFormRepeater.init();
});

var FeedbackRepeater = function () {
  // Initialize the outer repeater for feedback categories
  $(".feedback-cat").repeater({
    initEmpty: false, // Keeps the first item initialized

    defaultValues: {
      "text-input": "",
    },

    show: function () {
      $(this).slideDown();

      // Reinitialize the inner question repeater for this newly added category
      initQuestionRepeater($(this));
    },

    hide: function (deleteElement) {
      $(this).slideUp(deleteElement);
    },
  });

  // Initialize the question repeater for each category (call this once initially)
  $(".kt-repeater-item").each(function () {
    initQuestionRepeater($(this));
  });
};

// Function to initialize the question repeater for a given category element
function initQuestionRepeater(categoryElement) {
  categoryElement.find(".feedback-question").repeater({
    initEmpty: false, // Keeps the first question initialized

    defaultValues: {
      "text-input": "",
    },

    show: function () {
      $(this).slideDown();
    },

    hide: function (deleteElement) {
      $(this).slideUp(deleteElement);
    },
  });
}

// Ensure the repeaters are initialized when the document is ready
jQuery(document).ready(function () {
  FeedbackRepeater();
});
