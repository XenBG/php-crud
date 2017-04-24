    <h6>View Article</h6>
    <hr>
    <?php
        if($count > 0) {
            if(isset($error)) {
                header("Location: {$SITE_URL}");
            } else {
    ?>
    <div class="blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $article->title; ?></h2>
            <p class="blog-post-meta"><?php echo $article->date; ?> by <?php echo $article->author; ?></p>
            <?php echo $article->content; ?>
        </div>
    </div>
    <?php if($USER_LOGGED == 1){ ?>
        <hr>
        <a href="<?php echo $SITE_URL; ?>action/article/edit/<?php echo $article->id; ?>" class="btn btn-success">Edit</a> <a href="<?php echo $SITE_URL; ?>action/article/delete/<?php echo $article->id; ?>" class="btn btn-danger">Delete</a>
    <?php } } } else { header("Location: {$SITE_URL}"); } ?>