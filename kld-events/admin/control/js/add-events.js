// constant vars
let selectedPrograms = []
let selectedYearLevels = []
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

$("#kt_select2_11").change(function (){
    const programs = this.selectedOptions
    if (!programs && (typeof programs !== "object")) return
    selectedPrograms = Object.keys(programs).map((key) => {
        return programs[key].value
    })
    // kada bago ng program, check kung anung mga sections
    checkSections()
});

$("#yrlevel").change(function (){
    const yearlevels = this.selectedOptions
    if (!yearlevels && (typeof yearlevels !== "object")) return
    selectedYearLevels = Object.keys(yearlevels).map((key) => {
        return yearlevels[key].value
    })
    // kada bago ng yearlevel, check kung anung mga sections
    checkSections()
});

function checkSections() {
    if (!selectedPrograms || !selectedYearLevels) return
    var dataString = "ajax=add_event_check_sections"+
        "&selectedPrograms=" + btoa(selectedPrograms).replace(/\=/g, '') +
        "&selectedYearLevels=" + btoa(selectedYearLevels).replace(/\=/g, '');
    console.log(dataString)
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: dataString,
        cache: false,
        success: function (html) {
            console.log("html", html)
            if (!html) return
            $("#kt_select2_3").append(html)
        }
    });
}

$("#event_preview").click(function (){
    debugger
    var dataString = "ajax=preview_event"+
    "&venue_name=" + $("#venue_name").val() +
    "&event_start_date=" + $("#event_start_date").val() +
    "&event_end_date=" + $("#event_end_date").val() +
    "&event_title=" + $("#event_title").text() +

    "&event_organization=" + $("#event_organization").val() +
    "&inPerson_radio=" + $("#inPerson_radio").val() +
    "&virtual_radio=" + $("#virtual_radio").val() +
    "&toggleForms=" + $("#toggleForms").val() +
    "&kt_select2_11=" + $("#kt_select2_11").val() +
    "&toggleAllSections=" + $("#toggleAllSections").val() +
    "&kt_select2_3=" + $("#kt_select2_3").val() +
    "&yrlevel=" + $("#yrlevel").val() +
    "&toggleAllOrganization=" + $("#toggleAllOrganization").val() +
    "&kt_select_2_4=" + $("#kt_select_2_4").val() +
    "&toggleCap=" + $("#toggleCap").val() +
    "&kt_nouislider_1_input=" + $("#kt_nouislider_1_input").val() +
    "&kt_dropzone_1=" + $("#kt_dropzone_1").val() +
    "&kt_maxlength_5=" + $("#kt_maxlength_5").val() +


    "&event_description=" + $("#event_description").text() +
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