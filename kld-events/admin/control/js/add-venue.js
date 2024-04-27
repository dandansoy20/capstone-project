
$("#add_venue_cancel").click(function (){
    window.open("index.php","_self")
})

$("#add_venue_submit").click(function (){
    var dataString = "ajax=add_venue"+
        "&add_venue=" + $("#add_venue").val() +
        "&add_venue_description=" + $("#add_venue_description").val();
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