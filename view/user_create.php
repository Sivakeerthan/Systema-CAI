<form class="form-horizontal" action="/user/doCreate" method="post">
	<div class="component" data-html="true">
		<div class="form-group">
        <div class="form-group">
            <label class="col-md-2 control-label" for="fname">Vorname</label>
            <div class="col-md-4">
                <input id="fname" name="fname" type="text" placeholder="Vorname" class="form-control input-md" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="lname">Nachname</label>
            <div class="col-md-4">
                <input id="lname" name="lname" type="text" placeholder="Nachname" class="form-control input-md" required>
            </div>
        </div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="uname">Benutzername</label>
		  <div class="col-md-4">
		  	<input id="uname" name="uname" type="text" placeholder="Benutzername" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Passwort</label>
		  <div class="col-md-4">
		  	<input id="password" name="password" type="password" placeholder="Passwort" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Passwort wiederholen</label>
		  <div class="col-md-4">
		  	<input id="password2" name="password2" type="password" placeholder="Passwort" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="signup" type="submit" class="btn btn-primary" value="SIGN UP">
		  </div>
		</div>
	</div>
</form>
