//On triggers
$("#event_next_button").click(function (){
    $("#review_venue").text($("#venue_name").find(":selected").text())
    $("#review_date").text($("#event_start_date").val() + " - " + $("#event_end_date").val())
    $("#review_title").text($("#event_title").val())
    $("#review_description").text($("#event_description").val())
    $("#review_category").text($("#event_category").find(":selected").text())
    $("#review_organizer").text($("#event_organizer").find(":selected").text())
})

function imagefileinsert(e){
    var string = $(e).prop('files')[0];
    var file = new FileReader();
    file.readAsDataURL(string);
    //$(file).ready(function (){
    //});
    file.addEventListener("load", function () {
        $(e)[0].outerHTML = '<img src="'+file.result+'" contenteditable="true" />';
        e_editmode($('#e_editor_editbtn'),'1');
    }, false);
}

$("#event_submit").click(function (){
    var dataString = "ajax=add_event"+
        "&venue_id=" + $("#venue_name").val() +
        "&event_start_date=" + $("#event_start_date").val() +
        "&event_end_date=" + $("#event_end_date").val() +
        "&event_title=" + $("#review_title").text() +
        "&event_description=" + $("#review_description").text() +
        "&event_category=" + $("#event_category").val() +
        "&event_organizer=" + $("#event_organizer").val() +
        "&event_poster=" + btoa($("#kt_dropzone_1").prop("dropzone").files[0].dataURL);
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

$('#kt_dropzone_1').dropzone({
    url: "/",
    paramName: "file",
    maxFiles: 1,
    maxFilesize: 10
});