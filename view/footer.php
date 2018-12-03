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
    <script src="/js/main.js"></script>
    <script src='/js/plugins/fullcalendar/js/fullcalendar.min.js'></script>


        <?php
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['user'])):?>
                <?php include('../public/js/plugins/fullcalendar/calendar-script.js.php'); new Calendar($events,$absents);?>
                <?php if(isset($students)):?>
                <script>

                    $(document).ready(function(){
                        $('input.autocomplete').autocomplete({
                            data: <?php echo json_encode($students)?>,
                        });
                    });
                </script>
                <?php endif; ?>
        <?php endif;?>


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
