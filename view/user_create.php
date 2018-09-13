<form class="form-horizontal" action="/user/doCreate" method="post">
	<div class="component" data-html="true">
		<div class="form-group">
        <div class="form-group">
            <label class="col-md-2 control-label" for="fname">First Name</label>
            <div class="col-md-4">
                <input id="fname" name="fname" type="text" placeholder="First Name" class="form-control input-md" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="lname">Last Name</label>
            <div class="col-md-4">
                <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control input-md" required>
            </div>
        </div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="uname">Username</label>
		  <div class="col-md-4">
		  	<input id="uname" name="uname" type="text" placeholder="Username" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Password</label>
		  <div class="col-md-4">
		  	<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Password</label>
		  <div class="col-md-4">
		  	<input id="password2" name="password2" type="password" placeholder="Password" class="form-control input-md" required>
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
