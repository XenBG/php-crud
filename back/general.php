<?php
/**
 * General system settings
 *
 */

$SITE_URL = "http://77.76.191.33/crud/";
$PROJECT_NAME = "PHP CRUD Project";
$CURRENT_YEAR = date("Y", time());

date_default_timezone_set("Europe/Sofia"); // Change if you are from another country

/**
 * Checking if user is logged
 *
 */

if(isset($_COOKIE['crud_cookie'])){
	$stmt = $db->prepare("SELECT id FROM `users` WHERE user_hash=?");
	$stmt->bindValue(1, $_COOKIE['crud_cookie'], PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();

	if($count > 0){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$USER_LOGGED = 1;

		foreach ($rows as $row) {
			$USER_ID = $row["id"];
		}
	} else {
		$USER_LOGGED = 0;

		setcookie('crud_cookie', null, -1, '/');
	}
} else {
	$USER_LOGGED = 0;
}

/**
 * Checking Username for special chars
 *
 * @param $string
 * @return bool
 */

function filterUserName($string){
	if(preg_match('/[^a-zA-Z0-9_-]/', $string)){
		return true;
	} else {
		return false;
	}
}

/**
 * Returning Username from ID
 *
 * @param $id
 * @return string
 */

function getUserName($id)
{
	global $SITE_URL, $db;

	$sql = "SELECT id, user_name FROM `users` WHERE id = '{$id}'";
	$check = $db->query($sql);
	$count = $check->rowCount();

	if ($count > 0) {
		foreach ($db->query($sql) as $row) {
            $username = $row['user_name'];
		}
	} else {
		$username = 'Anonymous';
	}

	return $username;
}