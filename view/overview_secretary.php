<?php if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])): ?>
    <p>Sie sind nicht angemeldet.</p>
    <a href="/user/login/">anmelden</a>
<?php endif;
if (isset($_SESSION['user']) && $_SESSION['pos'] == 'se'): ?>
    </div>

    <div class="overview">
        <div id="calendar"></div>
        <div id="external-events"></div>
    </div>
    <div id="absence-form" class="container card hide insert-form">
        <form class="col s12" method="post" enctype="multipart/form-data" action="/overview/addAbsenceFromInfoDesk">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="abs_student_sec" name="abs_student" type="text" class="autocomplete">
                    <label for="abs_student_sec">Schüler</label>
                </div>
                <div id="avkont-col" class="input-field col s6 hide">
                    <span id="avkont-span"></span>
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
<?php else: header('Location /overview'); endif; ?>