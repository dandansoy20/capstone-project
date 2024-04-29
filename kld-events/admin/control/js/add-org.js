
$("#add_org_cancel").click(function (){
    window.open("index.php","_self")
})

$("#add_org_submit").click(function (){
    var dataString = "ajax=add_org"+
        "&add_org_organization=" + $("#add_org_organization").val() +
        "&add_org_description=" + $("#add_org_description").val();
    console.log(dataString)
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
            switch(html){
                case "1":
                    alert("Saved");
                    window.open("index.php", "_self")
                    break;
                case "2":
                    alert("Not saved!");
                    break;
                default:
                    alert("Something went wrong, please try again.");
                    console.log(html)

            }
        }
    });
})