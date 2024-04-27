$("#kld_admin_login_button").click(function (){
    var dataString = "ajax=logging_in"+
    "&login_type=admin" + 
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