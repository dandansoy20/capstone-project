
$("#add_cat_cancel").click(function (){
    window.open("index.php","_self")
})

$("#add_cat_submit").click(function (){
    var dataString = "ajax=add_cat"+
        "&add_cat_category=" + $("#add_cat_category").val() +
        "&add_cat_description=" + $("#add_cat_description").val();
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