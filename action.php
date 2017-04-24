<?php
include_once 'back/config/Database.php';

$database = new Database();
$db = $database->connect();

include 'back/general.php';

$operator = isset($_GET["operator"]) ? $_GET["operator"] : NULL;
$type = isset($_GET["type"]) ? $_GET["type"] : NULL;

switch($operator) {
    default:
        header("Location: {$SITE_URL}");
    break;

    case "user":
        if($type == "register") {
            if($USER_LOGGED == 1){
                header("Location: {$SITE_URL}");
            } else {
                $TITLE_PAGE = "Registration";

                include_once 'front/general_header.php';
                include_once 'back/class/User.php';

                $user = New User($db);

                if($_POST) {
                    $user->username = trim(htmlspecialchars($_POST['username']));
                    $user->password = trim(htmlspecialchars($_POST['password']));
                    $user->password_confirm = trim(htmlspecialchars($_POST['password_confirm']));
                    $user->email = trim(htmlspecialchars($_POST['email']));

                    if(empty($user->username)) {
                        $error[] = "Please enter username!";
                    } else if(filterUserName($user->username)) {
                        $error[] = "Please enter a valid username (only letters, numbers, underscore and dash allowed)!";
                    } else if(strlen($user->username) < 3){
                        $error[] = "Username must be atleast 3 characters!";
                    } else if(strlen($user->username) > 32){
                        $error[] = "Username must be less than 32 characters!";
                    } else if($user->email == "") {
                        $error[] = "Please enter email address!";
                    } else if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                        $error[] = 'Please enter a valid email address!';
                    } else if($user->password == "") {
                        $error[] = "Please enter password!";
                    } else if($user->password_confirm == "") {
                        $error[] = "Please confirm the password!";
                    } else if(strlen($user->password) < 6){
                        $error[] = "Password must be atleast 6 characters!";
                    } else if(strlen($user->password) > 32){
                        $error[] = "Password must be less than 32 characters!";
                    } else if($user->password != $user->password_confirm){
                        $error[] = "Passwords are not the same!";
                    } else {
                        try {
                            $sql = 'SELECT user_name, user_email FROM `users` WHERE user_name = :username OR user_email = :email';
                            $query = $db->prepare($sql);
                            $query->execute(
                                array(
                                    ':username' => $user->username,
                                    ':email' => $user->email
                                )
                            );
                            $row = $query->fetch(PDO::FETCH_ASSOC);

                            if($row['user_name'] == $user->username) {
                                $error[] = "Sorry, this username is already taken!";
                            }

                            if($row['user_email'] == $user->email) {
                                $error[] = "Sorry, this email address is already taken!";
                            }

                            if(!isset($error)) {
                                if($user->register()) {
                                    $joined[] = 'Your registration is done! You can <a href="'.$SITE_URL.'action/user/login" class="alert-link">login</a> now.';
                                } else {
                                    $error[] = "Sorry, something wrong happened! Please try again!";
                                }
                            }
                        } catch(PDOException $exception) {
                            echo "Error: ".$exception->getMessage();
                        }
                    }
                } else {
                    $user->username = "";
                    $user->email = "";
                }

                include_once 'front/user_registration.php';
                include_once 'front/general_footer.php';
            }
        } else if($type == "login") {
            if($USER_LOGGED == 1){
                header("Location: {$SITE_URL}");
            } else {
                $TITLE_PAGE = "Login";

                include_once 'front/general_header.php';
                include_once 'back/class/User.php';

                $user = New User($db);

                if($_POST) {
                    $username = trim(htmlspecialchars($_POST['user']));
                    $email = trim(htmlspecialchars($_POST['user']));
                    $password = trim(htmlspecialchars($_POST['password']));

                    if($user->login($username, $email, $password)) {
                        header("Location: {$SITE_URL}");
                    } else {
                        $error = "Wrong details given! Please try again!";
                    }
                } else {
                    $username = "";
                }

                include_once 'front/user_login.php';
                include_once 'front/general_footer.php';
            }
        } else if($type == "logout") {
            setcookie('crud_cookie', null, -1, '/');

            header("Location: {$SITE_URL}");
        } else {
            header("Location: {$SITE_URL}");
        }
    break;

    case "article":
        if($type == "view") {
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;
            $TITLE_PAGE = "Read Article";

            include_once 'front/general_header.php';
            include_once 'back/class/Article.php';

            $article = New Article($db);
            $article = $article->view($id);
            $count = $article->rowCount();

            if($count > 0) {
                while ($row = $article->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $article->id = $id;
                    $article->title = $row['article_title'];
                    $article->content = $row['article_content'];
                    $article->date = date('F d, Y', strtotime($row['article_date']));
                    $article->author = getUserName($row['article_author']);
                }
            }

            include_once 'front/article_view.php';
            include_once 'front/general_footer.php';
        } else if($type == "write") {
            if($USER_LOGGED == 1){
                $TITLE_PAGE = "New Article";

                include_once 'front/general_header.php';
                include_once 'back/class/Article.php';

                $article = New Article($db);

                if($_POST) {
                    $article->title = $_POST['title'];
                    $article->content = $_POST['content'];

                    if(empty($article->title)) {
                        $error[] = "Please enter title!";
                    } else if(strlen($article->title) < 3){
                        $error[] = "Title must be atleast 3 characters!";
                    } else if(strlen($article->title) > 255){
                        $error[] = "Title must be less than 255 characters!";
                    } else if($article->content == "") {
                        $error[] = "Please enter content!";
                    } else if(strlen($article->content) < 10){
                        $error[] = "Content must be atleast 10 characters!";
                    } else if(strlen($article->content) > 10000){
                        $error[] = "Content must be less than 10000 characters!";
                    } else {
                        try {
                            if($article->write()) {
                                $published = 'Successfully published! Now go to the <a href="'.$SITE_URL.'" class="alert-link">homepage</a> and see it.';
                            } else {
                                $error[] = "Sorry, something wrong happened! Please try again!";
                            }
                        } catch(PDOException $exception) {
                            echo "Error: ".$exception->getMessage();
                        }
                    }
                } else {
                    $article->title = "";
                    $article->content = "";
                }

                include_once 'front/article_write.php';
                include_once 'front/general_footer.php';
            } else {
                header("Location: {$SITE_URL}");
            }
        } else if($type == "edit") {
            if($USER_LOGGED == 1){
                $id = isset($_GET['id']) ? $_GET['id'] : NULL;
                $TITLE_PAGE = "Edit Article";

                include_once 'front/general_header.php';
                include_once 'back/class/Article.php';

                $article = New Article($db);
                $fetch = $article->fetch($id);
                $count = $fetch->rowCount();

                if($count > 0) {
                    if($_POST) {
                        $article->id = $id;
                        $article->title = trim($_POST['title']);
                        $article->content = trim($_POST['content']);

                        if(empty($article->title)) {
                            $error[] = "Please enter title!";
                        } else if(strlen($article->title) < 3){
                            $error[] = "Title must be atleast 3 characters!";
                        } else if(strlen($article->title) > 255){
                            $error[] = "Title must be less than 255 characters!";
                        } else if($article->content == "") {
                            $error[] = "Please enter content!";
                        } else if(strlen($article->content) < 10){
                            $error[] = "Content must be atleast 10 characters!";
                        } else if(strlen($article->content) > 10000){
                            $error[] = "Content must be less than 10000 characters!";
                        } else {
                            try {
                                if($article->update($id, $article->title, $article->content)) {
                                    $changed = 'Successfully updated! Now go <a href="'.$SITE_URL.'action/article/view/'.$id.'" class="alert-link">see the changes</a>.';
                                } else {
                                    $error[] = "Sorry, something wrong happened! Please try again!";
                                }
                            } catch(PDOException $exception) {
                                echo "Error: ".$exception->getMessage();
                            }
                        }
                    }

                    while ($row = $fetch->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);

                        $article->id = $id;
                        $article->title = $row['article_title'];
                        $article->content = $row['article_content'];
                    }
                }

                include_once 'front/article_edit.php';
                include_once 'front/general_footer.php';
            } else {
                header("Location: {$SITE_URL}");
            }
        } else if($type == "delete") {
            if($USER_LOGGED == 1){
                $id = isset($_GET['id']) ? $_GET['id'] : NULL;
                $delete = isset($_POST['delete']) ? $_POST['delete'] : NULL;
                $TITLE_PAGE = "Delete Article";

                include_once 'front/general_header.php';
                include_once 'back/class/Article.php';

                $article = New Article($db);
                $fetch = $article->fetch($id);
                $count = $fetch->rowCount();

                if($count > 0) {
                    $article->id = $id;

                    while ($row = $fetch->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);

                        $article->title = $row['article_title'];
                    }

                    if($delete) {
                        if($article->delete($id)) {
                            header("Location: {$SITE_URL}");
                        } else {
                            $error = "Sorry, something wrong happened! Please try again!";
                        }
                    }
                } else {
                    header("Location: {$SITE_URL}");
                }

                include_once 'front/article_delete.php';
                include_once 'front/general_footer.php';
            } else {
                header("Location: {$SITE_URL}");
            }
        } else {
            header("Location: {$SITE_URL}");
        }
    break;
}