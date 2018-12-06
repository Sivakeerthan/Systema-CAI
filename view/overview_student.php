<?php if(!isset($_SESSION)){session_start();}if(!isset($_SESSION['user'])):?>
    <p>Du bist nicht eingeloggt.</p>
    <a href="/user/login/">einloggen</a>
<?php endif; if(isset($_SESSION['user']) && $_SESSION['pos'] == 'st'):?>
</div>

<div class="overview">

    <div id="calendar"></div>
    <div id="external-events"></div>


</div>
<div id="absence-form" class="container card hide insert-form">
    <form class="col s12" method="post" enctype="multipart/form-data" action="/overview/addAbsence">
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
                <label>Anzahl Kontingent</label>
            </div>
        </div>
        <div class="form-group hide" id="disp-Info">
            <div class="row">
                <div class="input-field col s6">
                    <textarea name="disp_request" class="materialize-textarea" maxlength="200" data-length="200"></textarea>
                    <label>Nachricht</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s6">
                  <div class="btn">
                      <span>File</span>
                      <input type="file" id="doc_file" name="doc_file">
                  </div>
                    <div class="file-path-wrapper">
                        <input type="text" class="file-path validate" placeholder="Dokument hochladen">
                    </div>
                </div>
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
<?php if(isset($kkanzahl)&&isset($kkabsid)):?>
    <script>
        var allowed = confirm('Da, ein KK event in dieser Zeit stattfindet, wird diese Absenz als Unentschuldigt markiert.');
        if (allowed == true) {
            $(location).attr('href','/overview/unexcusedAllowed?a1=<?=$kkanzahl?>&a2=<?=$kkabsid?>');
        } else {
            $(location).attr('href','/overview/student');
        }
    </script>
    <?php endif;?>
<div class="container">
 <?php else: header('Location /overview'); endif;?>