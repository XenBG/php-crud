<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $TITLE_PAGE; ?></title>

        <meta charset="utf-8">

        <link href="<?php echo $SITE_URL; ?>front/codes/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $SITE_URL; ?>front/codes/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $SITE_URL; ?>front/codes/custom.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills float-right">
                        <?php
                            if($USER_LOGGED == 1){
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'" class="btn btn-secondary">Home</a></li>';
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'action/article/write" class="btn btn-secondary">New Article</a></li>';
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'action/user/logout" class="btn btn-secondary">Logout</a></li>';
                            } else {
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'" class="btn btn-secondary">Home</a></li>';
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'action/user/login" class="btn btn-secondary">Login</a></li>';
                                echo '<li class="nav-item btn-space"><a href="'.$SITE_URL.'action/user/register" class="btn btn-secondary">Registration</a></li>';
                            }
                        ?>
                    </ul>
                    <h3 class="text-muted"><?php echo $PROJECT_NAME; ?></h3>
                </nav>
            </div>
            <div class="row-fluid">
               <hr>