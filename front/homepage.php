    <h6>Articles List</h6>
	<hr>
    <?php
        if($count > 0) {
    ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th style="text-align: left;">Title</th>
				<th>Date &amp; Time</th>
				<th>Author</th>
				<?php
					if($USER_LOGGED == 1){
						echo '<th>Actions</th>';
					}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
                while ($row = $articles->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $articleDate = date('d.m.y, H:i', strtotime($row['article_date']));
                    $articleAuthorID = getUserName($row['article_author']);

                    echo '<tr>';
                    echo '<td style="text-align: center;">'.$row['id'].'</td>';
                    echo '<td style="width: 50%;"><a href="'.$SITE_URL.'action/article/view/'.$row['id'].'">'.$row['article_title'].'</a></td>';
                    echo '<td style="text-align: center;">'.$articleDate.'</td>';
                    echo '<td>'.$articleAuthorID.'</td>';
                    if ($USER_LOGGED == 1) {
                        echo '<td style="text-align: center;"><a href="'.$SITE_URL.'action/article/edit/'.$row['id'].'" class="btn btn-success btn-sm">Edit</a> <a href="'.$SITE_URL.'action/article/delete/'.$row['id'].'" class="btn btn-danger btn-sm">Delete</a></td>';
                    }
                    echo '</tr>';
                }
			?>
		</tbody>
	</table>
	<p class="small showing">Showing <strong><?php echo $count; ?></strong> articles.</p>
    <?php
        } else {
            if($USER_LOGGED == 1){
    ?>
    <div class="alert alert-danger" role="alert">
        No articles found. You can publish one from <a href="<?php echo $SITE_URL; ?>action/article/write" class="alert-link">this page</a>.
    </div>
    <?php } else { ?>
    <div class="alert alert-danger" role="alert">
        No articles found. <a href="<?php echo $SITE_URL; ?>action/user/register" class="alert-link">Register</a> or <a href="<?php echo $SITE_URL; ?>action/user/login" class="alert-link">login</a> to publish one.
    </div>
    <?php
            }
        }
    ?>