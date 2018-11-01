$(document).ready(function() {
    /* initialize the external events
    -----------------------------------------------------------------*/
    $('#external-events .fc-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true, // maintain when user navigates (see docs on the renderEvent method)
            color: '#00bcd4'
        });


    });


    /* initialize the calendar
    -----------------------------------------------------------------*/


});