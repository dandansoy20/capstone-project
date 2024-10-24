// Class definition
var KTFormRepeater = (function () {
  // Private functions

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
    var dropzoneCount = 1; // To track number of Dropzones added

    // Function to initialize Dropzone for each dynamically added container
    function initializeDropzone(dropzoneId) {
      var id = "#" + dropzoneId;

      var previewNode = $(id + " .dropzone-item");
      previewNode.id = "";
      var previewTemplate = previewNode.parent(".dropzone-items").html();
      previewNode.remove();

      var myDropzone = new Dropzone(id, {
        url: "https://keenthemes.com/scripts/void.php", // Set your upload URL
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        maxFilesize: 1, // Max filesize in MB
        autoQueue: false,
        previewsContainer: id + " .dropzone-items",
        clickable: id + " .dropzone-select",
      });

      myDropzone.on("addedfile", function (file) {
        file.previewElement.querySelector(id + " .dropzone-start").onclick =
          function () {
            myDropzone.enqueueFile(file);
          };
        $(document)
          .find(id + " .dropzone-item")
          .css("display", "");
        $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css(
          "display",
          "inline-block"
        );
      });

      myDropzone.on("totaluploadprogress", function (progress) {
        $(this)
          .find(id + " .progress-bar")
          .css("width", progress + "%");
      });

      myDropzone.on("sending", function (file) {
        $(id + " .progress-bar").css("opacity", "1");
        file.previewElement
          .querySelector(id + " .dropzone-start")
          .setAttribute("disabled", "disabled");
      });

      myDropzone.on("complete", function (progress) {
        var thisProgressBar = id + " .dz-complete";
        setTimeout(function () {
          $(
            thisProgressBar +
              " .progress-bar, " +
              thisProgressBar +
              " .progress, " +
              thisProgressBar +
              " .dropzone-start"
          ).css("opacity", "0");
        }, 300);
      });

      document.querySelector(id + " .dropzone-upload").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      };

      document.querySelector(id + " .dropzone-remove-all").onclick =
        function () {
          $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css(
            "display",
            "none"
          );
          myDropzone.removeAllFiles(true);
        };

      myDropzone.on("queuecomplete", function (progress) {
        $(id + " .dropzone-upload").css("display", "none");
      });

      myDropzone.on("removedfile", function (file) {
        if (myDropzone.files.length < 1) {
          $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css(
            "display",
            "none"
          );
        }
      });
    }

    // Initialize the form repeater
    $("#add_info_content").repeater({
      initEmpty: false,

      defaultValues: {
        "text-input": "foo",
      },

      show: function () {
        $(this).slideDown();

        // Increment Dropzone counter
        dropzoneCount++;
        var newDropzoneId = "kt_dropzone_" + dropzoneCount;

        // Assign a new unique ID to the Dropzone container
        $(this).find(".dynamic-dropzone").attr("id", newDropzoneId);

        // Initialize Dropzone for the newly added item
        initializeDropzone(newDropzoneId);
      },

      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
    });

    // Initialize the first Dropzone
    initializeDropzone("kt_dropzone_6");
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
      demo8();
      demo9();
    },
  };
})();

jQuery(document).ready(function () {
  KTFormRepeater.init();
});
