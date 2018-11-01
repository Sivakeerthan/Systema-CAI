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
                <label>Absenztyp wählen</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="date_start" class="datepicker">
                <label>Anfangsdatum</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="date_end" class="datepicker">
                <label>Enddatum</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="input-field inline">
                    <input id="email_inline" type="email" class="validate">
                    <label for="email_inline">Email</label>
                    <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container">