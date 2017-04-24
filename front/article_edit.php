	<h6>Edit Article</h6>
	<hr>
    <?php if(isset($error)) { ?>
        <div class="alert alert-danger">
            <?php foreach($error as $err) { ?>
                <i class="fa fa-warning"></i> &nbsp; <?php echo $err; ?><br />
            <?php } ?>
        </div>
        <hr>
    <?php } else if(isset($changed)) { ?>
        <div class="alert alert-success">
            <i class="fa fa-sign-in"></i> &nbsp; <?php echo $changed; ?>
        </div>
        <hr>
    <?php } if($count > 0){ ?>
	<form class="form-horizontal" role="form" method="post" action="<?php echo $SITE_URL; ?>action/article/edit/<?php echo $article->id; ?>">
		<div class="row">
			<div class="col-md-12 form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter article title" value="<?php echo $article->title; ?>" required autofocus />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group">
				<label for="content">Content</label>
				<textarea class="form-control article-form-content ckeditor" name="content" id="content" rows="3" placeholder="Enter article content" required><?php echo $article->content; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Edit Now</button>
			</div>
		</div>
	</form>
	<?php } else { header("Location: {$SITE_URL}"); } ?>