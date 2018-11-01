</div>

<div class="overview">

    <div id="calendar"></div>
    <div id="external-events"></div>


</div>
<div id="absence-form" class="container card">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s6">
                <select id="absence-type" name="absence-type">
                    <option value="kont">Kontingent</option>
                    <option value="disp">Dispensation</option>
                </select>
                <label>Absenzart</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="date_start" class="datepicker" value="<?= $today ?>">
                <label>Anfangsdatum</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="date_end" class="datepicker" value="<?= $today ?>">
                <label>Enddatum</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="number" name="anz-HT">
                <label>Anzahl Halbtage</label>
            </div>
        </div>
        <div class="form-group" id="disp-Info">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="disp_request" maxlength="100">
                    <label>Anfrage</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="number" name="anz-HT">
                    <label>Anzahl Halbtage</label>
                </div>
            </div>
         </div>

    </form>
</div>
<div class="container">