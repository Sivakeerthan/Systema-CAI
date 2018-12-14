$(document).ready(function () {
    var previous = $(".form-btn").text();
    $(".form-btn").click(function () {

       if($(".insert-form").hasClass("hide")){
           $(".overview").addClass("hide");
           $(".insert-form").removeClass("hide");
           $(".form-btn").text("Abbrechen");
       }
        else{
           $(".overview").removeClass("hide");
           $(".insert-form").addClass("hide");
           $(".form-btn").text(previous);
        }
        $('textarea').characterCounter();
    });

    $('.datepicker').datepicker();
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
    $('.collapsible').collapsible();

    //tooltip

    $('.tooltip-div').click(function () {
        if($('.tooltip-content').hasClass(("tooltip-visible"))){
            $('.tooltip-content').removeClass("tooltip-visible");
            $('#huname').css("color","#ffffff");
        }
        else{
            $('.tooltip-content').addClass("tooltip-visible");
            $('#huname').css("color","#bfbfbf");
        }
    });

});
$('#absence-type').on('change',function () {
   if(this.value === "disp"){
       $('#disp-Info').removeClass("hide");
   }
   else{
       $('#disp-Info').addClass("hide");
   }
});

//Display available Kontingent for sec
$('#abs_student_sec').on('change',function(){
    var fullname = $('#abs_student_sec').val();
    var temp = fullname.split(" ");
    var fname = temp[0];
    var lname = temp[1];
    $.ajax({
        type: 'POST',
        url:'/overview/getKontForSec',
        data: {'fname_sec':fname,'lname_sec':lname},
        success: function (output) {
            $('#avkont-col').removeClass("hide");
            $('#avkont-span').text("hat noch "+output+" Kontingent");
        }
    });
});