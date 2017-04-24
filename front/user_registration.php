	<h6>Register New User</h6>
	<hr>
    <?php if(isset($error)) { ?>
    <div class="alert alert-danger">
    <?php foreach($error as $err) { ?>
        <i class="fa fa-warning"></i> &nbsp; <?php echo $err; ?><br />
    <?php } ?>
    </div>
	<hr>
    <?php } else if(isset($joined)) { ?>
    <div class="alert alert-success">
        <i class="fa fa-sign-in"></i> &nbsp; Successfully registered! Now go <a href='<?php echo $SITE_URL; ?>action/user/login' class="alert-link">login</a>.
    </div>
	<hr>
    <?php } ?>
	<form class="form-horizontal" role="form" method="post" action="<?php echo $SITE_URL; ?>action/user/register">
		<div class="row">
			<div class="col-md-3 field-label-responsive">
				<label for="name">Username</label>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
						<input type="text" name="username" class="form-control" id="name" placeholder="Geralt_of_Rivia" value="<?php echo $user->username; ?>" required autofocus />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 field-label-responsive">
				<label for="email">Email</label>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
						<input type="text" name="email" class="form-control" id="email" placeholder="Geralt@thewitcher.com" value="<?php echo $user->email; ?>" required />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 field-label-responsive">
				<label for="password">Password</label>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password" required />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 field-label-responsive">
				<label for="password">Confirm Password</label>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem">
							<i class="fa fa-repeat"></i>
						</div>
						<input type="password" name="password_confirm" class="form-control" id="password-confirm" placeholder="Confirm Password" required />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9">
				<button type="submit" class="btn btn-primary">Register Now</button>
			</div>
		</div>
	</form>