$(document).ready(function () {
    $(".form-btn").click(function () {
       if(($("#absence-form").css("display","none")) && ($("#calendar").css("display","block"))){
           $("#calendar").css("display", "none");
           $("#absence-form").css("display", "block");

       }
    });
    $('.datepicker').datepicker();
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});