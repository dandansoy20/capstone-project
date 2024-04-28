$("#kld_submit").click(function (){
    if(passwordValidator($("#kld_password").val(),$("#kld_password2").val())){
        if($("#kld_signup_fname").val() == ""){
            Swal.fire("Please specify the first name!", "", "error");
            return false
        }
        else if($("#kld_signup_lname").val() == ""){
            Swal.fire("Please specify the last name!", "", "error");
            return false
        }
        else if($("#kld_username").val() == ""){
            Swal.fire("Please specify the username!", "", "error");
            return false
        }
        var dataString = "ajax=add_std_info"+
            "&kld_signup_fname="+ $("#kld_signup_fname").val() +
            "&kld_signup_lname="+ $("#kld_signup_lname").val() +
            "&kld_username="+ $("#kld_username").val() +
            "&kld_password="+ $("#kld_password").val();
        console.log(dataString)
        $.ajax({
            type: "POST",
            url: "admin/ajax.php",
            data: dataString,
            cache: false,
            success: function (html) {
                switch(html){
                    case "success":
                        Swal.fire("Account successfully created!", "Redirecting to homepage...", "success");
                        setTimeout(function (){
                                window.open("index.php", "_self")
                            },5000 // 5 seconds
                        )

                        break;
                    case "failed":
                        Swal.fire("Something went wrong while saving account", "Please try again!", "error");
                        break;
                    default:
                        alert("Something went wrong, please try again.");
                        console.log(html)

                }
            }
        });
    }
})

function passwordValidator(pass, pass2){
    if(pass.toString().length < 8){
        Swal.fire("Password should be minimum 8 characters", "Please try again!", "error");
        return false
    }
    else if(!/[A-Z]/.test(pass)){
        Swal.fire("Password must contains uppercase character", "Please try again!", "error");
        return false
    }
    else if(!/[a-z]/.test(pass)){
        Swal.fire("Password must contains lowercase character", "Please try again!", "error");
        return false
    }
    else if(!/[0-9]/.test(pass)){
        Swal.fire("Password must contains number", "Please try again!", "error");
        return false
    }
    else if(!/[^A-Za-z0-9]/.test(pass)){
        Swal.fire("Password must contains special character", "Please try again!", "error");
        return false
    }
    else if (pass !== pass2){
        Swal.fire("Password does not match!", "Please try again!", "error");
        return false
    }
    return true
}