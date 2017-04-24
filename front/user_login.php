	<h6>Login</h6>
	<hr>
    <?php if(isset($error)) { ?>
    <div class="alert alert-danger">
        <i class="fa fa-warning"></i> &nbsp; <?php echo $error; ?><br />
    </div>
	<hr>
    <?php } ?>
	<form class="form-horizontal" role="form" method="post" action="<?php echo $SITE_URL; ?>action/user/login">
		<div class="row">
			<div class="col-md-3 field-label-responsive">
				<label for="name">Username or Email</label>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
						<input type="text" name="user" class="form-control" id="name" placeholder="Geralt_of_Rivia" value="<?php echo $username; ?>" autofocus />
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
						<input type="password" name="password" class="form-control" id="password" placeholder="Password" />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9">
				<button type="submit" class="btn btn-primary">Login Now</button>
			</div>
		</div>
	</form>