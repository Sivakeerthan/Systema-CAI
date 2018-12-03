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
});
$('#absence-type').on('change',function () {
   if(this.value === "disp"){
       $('#disp-Info').removeClass("hide");
   }
   else{
       $('#disp-Info').addClass("hide");
   }
});