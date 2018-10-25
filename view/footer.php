        <hr>
        <footer>
          <p>&copy; Copyright MVC Framework from gibb/BBC
          </br>
          Projekt von Jerico Lua, Sivakeerthan Vamanarajasekaran, Dominik Schmalstieg und Joel Feller</p>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src='/js/plugins/fullcalendar/lib/moment.min.js'></script>
    <script src='/js/plugins/fullcalendar/lib/jquery.min.js'></script>
    <script src='/js/plugins/fullcalendar/js/fullcalendar.min.js'></script>
    <script>
            $(document).ready(function () {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    defaultDate: new Date(),
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
                    eventLimit: true, // allow "more" link when too many events
                    events: [
                        <?php foreach ($events AS $event):?>
                        {

                            title: "<?=$event->name?>",
                            start: "<?=$event->date?>",
                            color:"<?php if($event->isKK){
                                echo "#D32F2F";
                            }
                            else{
                                echo "#757575";
                            }?>"
                        },
                        <?php endforeach;?>
                    ]
                });
            });

        </script>
        <?php
        if(isset($_SESSION['user'])):?>

        <?php endif;?>
    <script src='/js/plugins/fullcalendar/calendar-script.js'></script>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="/materialize/js/materialize.min.js"></script>
        <?php
        if(isset($_SESSION['err'])):
        foreach($_SESSION['err'] as $error):?>
        <script type="text/javascript">
            M.toast({html: '<?=$error?>'})
        </script>
        <?php endforeach;
                endif;
                $_SESSION['err'] = null; ?>

  </body>
</html>
