<?php if(!isset($_SESSION)){session_start();}if(!isset($_SESSION['user'])):?>
    <p>Du bist nicht eingeloggt.</p>
    <a href="/user/login/">einloggen</a>
<?php endif; if(isset($_SESSION['user']) && $_SESSION['pos'] == 'pr'):?>
    </div>

    <div class="overview">
        <?php if (!empty($pending_absents) && reset($pending_absents)->isU != 1 && reset($pending_absents)->isA != 1): ?>

            <div id="control-list">
                <ul class="collapsible">
                    <li class="collection-header">Absenzen</li>
                    <?php foreach ($pending_absents as $absent): ?>
                        <li>
                            <div class="collapsible-header"><?= $absent->fname ?>
                                am <?= date("d-M", strtotime($absent->sdate)) ?></div>
                            <div class="collapsible-body">
                                <table class="responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Vorname</th>
                                        <th>Klasse</th>
                                        <th>Von</th>
                                        <th>Bis</th>
                                        <th>Mitteilung</th>
                                        <?php if(isset($absent->doc)):?><th>Dokument</th><?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?= $absent->lname ?></td>
                                        <td><?= $absent->fname ?></td>
                                        <td><?= $absent->cname ?></td>
                                        <td><?= date("d-M", strtotime($absent->sdate)) ?></td>
                                        <td><?= date("d-M", strtotime($absent->edate)) ?></td>
                                        <td><?= $absent->msg ?></td>
                                        <?php if(isset($absent->doc)):?><td><a href="/overview/open?path=<?=str_replace(array("/uploads/files/disp/",".pdf"),array("",""),$absent->doc)?>" target="_blank"><i class="material-icons">insert_drive_file</i></a></td><?php endif; ?>
                                    </tr>
                                    </tbody>
                                </table>
                                <a class="waves-effect waves-light btn"
                                   href="/overview/doAcceptDisp?id1=<?= $absent->absId ?>&id2=<?=$absent->disp_id?>"><i class="material-icons left">check</i>Akzeptieren</a>
                                <a class="waves-effect waves-light btn"
                                   href="/overview/doDeclineDisp?id1=<?= $absent->absId ?>&id2=<?=$absent->disp_id?>"><i class="material-icons left">not_interested</i>Ablehnen</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        <div id="calendar"></div>
        <div id="external-events"></div>


    </div>
    <div id="event-form" class="container card hide insert-form">
        <form class="col s12" method="post" enctype="multipart/form-data" action="/overview/addEvent">
            <div class="row">
                <div class="input-field col s6">
                    <input id="ev_name" name="ev_name" type="text">
                    <label for="ev_name">Name</label>
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
                    <p>
                        <label>
                            <input type="checkbox" name="isKK">
                            <span>Kein Kontingent</span>
                        </label>
                    </p>
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
<?php else: header('Location /overview'); endif; ?>