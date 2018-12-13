<?php

/**
 * Class Calendar
 * @version 1.0
 * @author Sivakeerthan Vamanarajasekaran
 */
class Calendar
{
    private $absents = array();
    private $events = array();

    /**
     * Calendar constructor.
     * @param array $absents
     * @param array $events
     */
    public function __construct(array $events, array $absents)
    {
        $this->absents = $absents;
        $this->events = $events;
        echo "events-array:" . print_r($events);
        $this->build();
    }

    /**
     * Builds the Script string for the Calendar.
     */
    private function build()
    {
        //Start (sets Properties)
        echo " <script>
            $(document).ready(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,'
                },
                defaultDate: new Date(),
                editable: false,
                droppable: false,
                draggable: false,// this allows things to be dropped onto the calendar
                locale: 'de-ch',
                eventLimit: true, // allow 'more' link when too many events
                events: [
                ";
        // Inserts Events
        if (isset($this->events)) {
            echo "{}";
            foreach ($this->events AS $event) {
                echo "
                  ,{
        
                title: '" . $event->name . "',
                    start: '" . $event->date . "',
                color:'";
                if ($event->isKK) {
                    echo "#D32F2F";
                } else {
                    echo "#757575";
                }
                echo "'
        }
        ";
            }
        }
        // Inserts Absents
        if (isset($this->absents)) {
            foreach ($this->absents AS $absent) {
                echo "
            ,{
        
                title: 'Absenz',
                    start: '" . $absent->date_start . "',
                end:'" . $absent->date_end . "',               
                color:'";
                if ($absent->isKontingent && $absent->isExcused) {
                    echo "#8BC34A";
                } elseif ($absent->isDispensation && $absent->isExcused) {
                    echo "#CDDC39";
                } elseif ($absent->isKontingent && $absent->isUnexcused) {
                    echo "#b71c1c";
                } elseif ($absent->isDispensation && $absent->isUnexcused) {
                    echo "#d32f2f";
                } else {
                    echo "#757575";
                }
                echo "'
        }";
            }
        }
        // End
        echo "
        ]
        });
        });
        
        </script>";
    }
}

?>