<?php
/**
 * Created by IntelliJ IDEA.
 * User: vmadmin
 * Date: 13.12.2018
 * Time: 10:18
 */
if(isset($_SESSION['user'])):
    ?>
    <form class="form-horizontal" action="/user/changeDetails" method="post">
	<div class="component" data-html="true">
        <div class="form-group">
            <label class="col-md-2 control-label" for="uname">Benutzername</label>
            <div class="col-md-4">
                <p class="pdetails"><?=$_SESSION['user']?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="fname">Vorname</label>
            <div class="col-md-4">
                <p class="pdetails"><?=$user->firstname?></p>
            </div>
        </div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="lname">Nachname</label>
		  <div class="col-md-4">
              <p class="pdetails"><?=$user->lastname?></p>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">neue Passwort</label>
		  <div class="col-md-4">
		  	<input id="password" name="changepassword" type="password" placeholder="Passwort" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="changeinput" type="submit" class="btn btn-primary" value="ÄNDERUNG/EN ÜBERNEHMEN">
		  </div>
		</div>
	</div>
</form>
<?php endif; ?>