</div>

<div class="overview">

    <div id="calendar"></div>
    <div id="external-events"></div>


</div>
<div id="absence-form" class="container card">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s12">
                <select id="absence-type" name="absence-type">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label>Materialize Select</label>
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