	<h6>Delete Article</h6>
	<hr>
    <?php if(isset($error)) { ?>
        <div class="alert alert-danger">
            <i class="fa fa-warning"></i> &nbsp; <?php echo $error; ?>
        </div>
        <hr>
    <?php } else { if($count > 0){ ?>
	<form class="form-horizontal" role="form" method="post" action="<?php echo $SITE_URL; ?>action/article/delete/<?php echo $article->id; ?>">
		<div class="row">
			<div class="col-md-12 form-group">
				<label for="content">Are you sure you want to delete "<?php echo $article->title; ?>" article?</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="submit" class="btn btn-primary" name="delete" value="Delete Now" />
			</div>
		</div>
	</form>
	<?php } else { header("Location: {$SITE_URL}"); } } ?>