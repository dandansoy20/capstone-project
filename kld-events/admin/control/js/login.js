$("#kld_admin_login_button").click(function (){
    var dataString = "ajax=logging_in"+
    "&login_type=" + $("#login_type").val() +
    "&username=" + $("#kld_username").val() +
    "&password=" + $("#kld_password").val();
    console.log(dataString)
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
            switch(html){
                case "success":
                    //Swal.fire("Incorrect Username/Password", "Please try again!", "success");
                    window.open("index.php", "_self")
                    break;
                case "failed":
                    Swal.fire("Incorrect Username/Password", "Please try again!", "error");
                    console.log(html)
                    break;
                default:
                    alert("Something went wrong, please try again.");
                    console.log(html)

            }
        }
    });
})
$("#kld_password").keypress(function (e) {
    if (e.which == 13) {
        $('#kld_admin_login_button').click();
        e.preventDefault();
    }
});

$("#kld_form_submit").click(function (){
    if(passwordValidator($("#kld_username_pass1").val(),$("#kld_username_pass2").val())){
        var dataString = "ajax=create_account"+
        "&account_type=" + $("#login_type").val() +
        "&firstname=" + $("#kld_firstname_admin").val() +
        "&lastname=" + $("#kld_lastname_admin").val() +
        "&username=" + $("#kld_username_admin").val() +
        "&password=" + $("#kld_username_pass1").val();
        console.log(dataString)
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: dataString,
            cache: false,
            success: function (html) {
                switch(html){
                    case "success":
                        _showForm('signin');
                        Swal.fire("Account successfully created!", "Please try again!", "success");
                        break;
                    case "failed":
                        Swal.fire("Incorrect Username/Password", "Please try again!", "error");
                        break;
                    default:
                        Swal.fire("Something went wrong, please try again.", "Please try again!", "info");
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