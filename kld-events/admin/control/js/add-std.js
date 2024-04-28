$("#add_std_yearlvl").change(function (){
    if(!isNaN(parseInt(this.value))){ // kapag may year na sinelect, tsaka lang gagana yung dropdown ng section
        $("#add_std_section").removeAttr("disabled")
    } else {
        $("#add_std_section").attr("disabled","disabled")
    }
    var section = $("#std_add_section_options")
    var section2 = $("#add_std_section")
    var options = section.find("option")
    section2.html(options.filter('[data-yrlvl="' + $("#add_std_yearlvl").val() + '"]'))
    section2.val(section2.find("option:first").val())
})

$("#add_std_submit").click(function (){
    if(validateForm()){
        var dataString = "ajax=add_std"+
            "&add_std_profilepic="+ imagefileinsert(document.getElementById("add_std_profilepic")) +
            "&add_std_firstname="+ $("#add_std_firstname").val() +
            "&add_std_lastname="+ $("#add_std_lastname").val() +
            "&add_std_course="+ $("#add_std_course").val() +
            "&add_std_yearlvl="+ $("#add_std_yearlvl").val() +
            "&add_std_section="+ $("#add_std_section").val() +
            "&add_std_kldnum="+ $("#add_std_kldnum").val() +
            "&add_std_email=" + $("#add_std_email").val()
        console.log(dataString)
        $.ajax({
            type: "POST",
            url: "ajax.php",
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
                        alert("Not saved!");
                        break;
                    default:
                        alert("Something went wrong, please try again.");
                        console.log(html)

                }
            }
        });
    }
})

function imagefileinsert(e){
    var string = $(e).prop('files')[0];
    if(!string) return false
    var file = new FileReader();
    file.readAsDataURL(string);
    $(file).ready(function (){
        return btoa(file.result);
    });
}

function validateForm(){
    if($("#add_std_course").val() == ""){
        Swal.fire("Please specify the course!","Please try again!","error")
        return false
    }
    else if($("#add_std_yearlvl").val() == ""){
        Swal.fire("Please specify the year level!","Please try again!","error")
        return false
    }
    else if($("#add_std_section").val() == ""){
        Swal.fire("Please specify the section!","Please try again!","error")
        return false
    }
    else if($("#add_std_kldnum").val() == ""){
        Swal.fire("Please specify the KLD Number!","Please try again!","error")
        return false
    }
    else if($("#add_std_email").val() == ""){
        Swal.fire("Please specify the email!","Please try again!","error")
        return false
    }
    return true
}