$(document).ready(function () {
    $(".form-btn").click(function () {
       $("#calendar").css("display","none");
       $("#absence-form").css("display","block");
    });
    $('.datepicker').datepicker();
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});