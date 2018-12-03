<?php if(!isset($_SESSION)){session_start();} if(isset($_SESSION['user']) && $_SESSION['pos'] == 'pr'):?>
    </div>

    <div class="overview">
        <?php if(isset($pending_absents) && reset($pending_absents)->isU != 1 && reset($pending_absents)->isA != 1):?>

            <div id="control-list">
                <ul class="collapsible">
                    <li class="collection-header">Absenzen</li>
                    <?php foreach($pending_absents as $absent):?>
                        <li>
                            <div class="collapsible-header"><?=$absent->fname?> am <?=date("d-M",strtotime($absent->date))?></div>
                            <div class="collapsible-body">
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Vorname</th>
                                        <th>Klasse</th>
                                        <th>Datum</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?=$absent->lname?></td>
                                        <td><?=$absent->fname?></td>
                                        <td><?=$absent->cname?></td>
                                        <td><?=date("d-M",strtotime($absent->date))?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a class="waves-effect waves-light btn" href="/overview/doAccept?id=<?=$absent->absId?>"><i class="material-icons left">check</i>Akzeptieren</a>
                                <a class="waves-effect waves-light btn" href="/overview/doDecline?id=<?=$absent->absId?>"><i class="material-icons left">not_interested</i>Ablehnen</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php        echo"Pending Absents:".print_r($pending_absents); endif; ?>
        <div id="calendar"></div>
        <div id="external-events"></div>


    </div>
    <div id="event-form" class="container card hide insert-form">
        <form class="col s12" method="post" enctype="multipart/form-data" action="/overview/addUnexcused">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="abs_student" name="abs_student" type="text" class="autocomplete">
                    <label for="abs_student">Schüler</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="date" class="datepicker" value="<?= $today ?>">
                    <label>Datum</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="number" name="anz_lessons">
                    <label>Gefehlte Lektionen</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="submit">Senden
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>

        </form>
    </div>
    <div class="container">
<?php else: header('Location /overview'); endif;?>