<?php
$TITLE_PAGE = "Homepage";

include_once 'back/config/Database.php';

$database = new Database();
$db = $database->connect();

include_once 'back/general.php';
include_once 'front/general_header.php';

include_once 'back/class/Article.php';
include_once 'back/class/User.php';

$article = new Article($db);
$author = new User($db);

$articlesRows = 10;
$articlesField = "id";
$articlesOrder = "DESC";

$articles = $article->listing($articlesField, $articlesOrder, $articlesRows);
$count = $articles->rowCount();

include_once 'front/homepage.php';
include_once 'front/general_footer.php';