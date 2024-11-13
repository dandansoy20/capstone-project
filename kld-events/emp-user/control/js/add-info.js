// Function to convert image to base64
async function imagefileinsert(e) {
  var file = $(e).prop("files")[0];
  if (!file) return false;
  const result = await new Promise((resolve, reject) => {
    var reader = new FileReader();

    reader.onload = function (event) {
      resolve(btoa(event.target.result)); // Convert image to base64 string
    };

    reader.onerror = function (error) {
      reject(error); // Handle errors
    };

    reader.readAsDataURL(file);
  });
  return result;
}

// Handler for event submission
$("#add_info").click(function () {
  // Run validation before proceeding
  if (!validateForm()) {
    return; // Stop if validation fails
  }

  // Initialize dataString
  let dataString = "ajax=add_info";

  // Collect form data (image, title, description) from repeater items
  const add_info_content = [];
  $("#add_info_content .kt-repeater-item").each(async function () {
    const imageInput = $(this).find(".image-input input[type='file']");
    const titleInput = $(this).find("input[type='text']");
    const descriptionInput = $(this).find("textarea");

    // Handle image file conversion to base64
    const base64Image = await imagefileinsert(imageInput[0]);

    // Push collected data (base64 image, title, description) into array
    add_info_content.push({
      image: base64Image, // Base64 encoded image
      title: titleInput.val(),
      description: descriptionInput.val(),
    });
  });

  // Ensure all data is collected before sending AJAX
  if (add_info_content.length > 0) {
    dataString += "&event_contents=" + JSON.stringify(add_info_content);

    // Log the collected data for debugging
    console.log("Data sent to server: ", dataString);

    // AJAX call to submit the data
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: dataString,
      cache: false,
      success: function (response) {
        const data = JSON.parse(response); // Parse the JSON response
        console.log("Server response:", data);

        if (data.status === "success") {
          Swal.fire(
            "Event created successfully!",
            "Redirecting to your event...",
            "success"
          );
          setTimeout(function () {
            window.open(
              "index.php?page=pending-view&event_id=" + data.event_id,
              "_self"
            );
          }, 5000); // Redirect after 5 seconds
        } else {
          Swal.fire("Something went wrong: " + data.message, "", "error");
        }
      },
    });
  } else {
    Swal.fire("Please add event content", "", "error");
  }
});
