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
    });

    $('.datepicker').datepicker();
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});