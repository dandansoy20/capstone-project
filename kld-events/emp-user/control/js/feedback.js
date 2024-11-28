$("#submit_feedback_emp").click(function () {
  if (feedbackValidateForm()) {
    // Exit if validation fails

    Swal.fire({
      title: "Are you sure you want to submit feedback for the event?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `Don't Submit`,
    }).then((result) => {
      if (result.isConfirmed) {
        // Disable the button and change the text
        $("#submit_feedback_emp").text("Submitting...").prop("disabled", true);

        // Collect all form data, including the questions and answers
        var event_id = $("#event_id").val();
        var emp_id = $("#emp_id").val();
        var responses = [];

        // Loop through each question and collect the selected answer
        $("input[type='radio']:checked").each(function () {
          var question_id = $(this).attr("name").split("_")[1];
          var response = $(this).val();
          responses.push({ question_id: question_id, response: response });
        });

        // Prepare data to send
        var dataString = {
          ajax: "submit_feedback_emp",
          event_id: event_id,
          emp_id: emp_id,
          responses: JSON.stringify(responses), // Convert to JSON string
        };

        // Send the data via AJAX
        $.ajax({
          type: "POST",
          url: "../admin/ajax.php",
          data: dataString,
          success: function (response) {
            console.log(response);
            if (response.trim() === "success") {
              Swal.fire("Great!", "Feedback submitted!", "success").then(() => {
                window.open(
                  `?page=attended-view&event_id=${event_id}`,
                  "_self"
                );
              });
            } else {
              Swal.fire(
                "Error!",
                "There was an issue submitting your feedback.",
                "error"
              ).then(() => {
                $("#submit_feedback_emp")
                  .text("Submit")
                  .prop("disabled", false);
              });
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error: ", error);
            Swal.fire(
              "Error!",
              "Something went wrong. Please try again later.",
              "error"
            ).then(() => {
              $("#submit_feedback_emp").text("Submit").prop("disabled", false);
            });
          },
        });
      } else if (result.isDenied) {
        Swal.fire("Feedback not submitted", "", "info");
      }
    });
  }
});

$("#agree_form").click(function () {
  KTApp.blockPage({
    overlayColor: "#000000",
    state: "danger",
    message: "Please wait...",
  });

  setTimeout(function () {
    KTApp.unblockPage();
  }, 1000);
});

document.getElementById("agree_form").addEventListener("change", function () {
  const feedbackForms = document.getElementById("feedback-forms-emp");
  if (this.checked) {
    feedbackForms.classList.remove("d-none");
  } else {
    feedbackForms.classList.add("d-none");
  }
});

function feedbackValidateForm() {
  let allAnswered = true;

  // Loop through all radio button groups
  $("input[type='radio']").each(function () {
    const name = $(this).attr("name");
    if ($(`input[name='${name}']:checked`).length === 0) {
      allAnswered = false;
      return false; // Exit the loop early if a question is unanswered
    }
  });

  if (!allAnswered) {
    Swal.fire(
      "Please answer all the questions!",
      "Ensure every question has a selected answer.",
      "error"
    );
    return false;
  }

  return true;
}
