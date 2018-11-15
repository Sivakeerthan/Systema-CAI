$(document).ready(function () {
    $(".form-btn").click(function () {
       if($("#absence-form").hasClass("hide")){
           $("#calendar").addClass("hide");
           $("#absence-form").removeClass("hide");

       }
        else{
           $("#calendar").removeClass("hide");
           $("#absence-form").addClass("hide");
        }
        $('textarea').characterCounter();
    });

    $('.datepicker').datepicker();
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});
$('#absence-type').on('change',function () {
   if(this.value === "disp"){
       $('#disp-Info').removeClass("hide");
   }
   else{
       $('#disp-Info').addClass("hide");
   }
});