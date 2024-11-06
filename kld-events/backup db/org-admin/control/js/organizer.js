
function hideOrganizer (id) {
    Swal.fire({
        title: 'Are you sure to hide this Organizer?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        customClass: {
          actions: 'my-actions',
          cancelButton: 'order-1 right-gap',
          confirmButton: 'order-2',
        },
      }).then((result) => {
        if (result.isConfirmed) {
            var dataString = "ajax=hide_org"+
                "&org_acc_id=" + id;
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    console.log(html)
                    Swal.fire('Archived!', '', 'success')
                    $("#org_acc_container" + id).remove()
                }
            });
        }
      })
}

function editOrganizer (id) {

}


$("#add_org_submit").click(async function (){
    if(validateForm()){
        $(this).text("Submitting")
        $(this).prop("disabled","disabled")
        var profilePic = await imagefileinsert(document.getElementById("add_org_profilepic"))
        var dataString = "ajax=add_org_user"+
            "&add_org_profilepic="+ profilePic +
            "&add_org_fname="+ $("#add_org_fname").val() +
            "&add_org_lname="+ $("#add_org_lname").val() +
            "&add_org_organization="+ $("#add_org_organization").val() +
            "&add_org_role="+ $("#add_org_role").val() +
            "&add_org_kldid="+ $("#add_org_kldid").val() +
            "&add_org_email=" + $("#add_org_email").val()
        console.log("DATASTRING", dataString)
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: dataString,
            cache: false,
            success: function (html) {
                switch(html){
                    case "success":
                        Swal.fire("Organizer account successfully created!", "Redirecting to homepage...", "success");
                        setTimeout(function (){
                            window.open("index.php", "_self")
                        },15000 // 5 seconds
                        )
                        break;
                    default:
                        Swal.fire("Something went wrong, please try again later!", "", "error");
                        console.log(html)

                }
            }
        });
    }
});

function validateForm(){
    if($("#add_org_kldid").val() == ""){
        Swal.fire("Please specify the KLD Number!","Please try again!","error")
        return false
    }
    else if($("#add_org_email").val() == ""){
        Swal.fire("Please specify the email!","Please try again!","error")
        return false
    }
    return true
}

async function imagefileinsert(e) {
    var file = $(e).prop('files')[0];
    if (!file) return false;
    const result = await new Promise((resolve, reject) => {
        var reader = new FileReader();

        reader.onload = function(event) {
            // Resolve the promise with the base64 encoded string
            resolve(btoa(event.target.result)); // Get the base64 part
        };

        reader.onerror = function(error) {
            reject(error);
        };

        reader.readAsDataURL(file);
    });
    return result
}
