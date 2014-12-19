<?php
function startsWith($haystack, $needle) {
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

include_once 'includes/functions.php';

if (session_status() == PHP_SESSION_NONE) {
	sec_session_start();
}

include_once 'includes/db_connect.php';
include_once 'includes/backenduploading.php';

// Load requested file and authorized user id
$requestedFile = $_GET['target'];
$currentUserID = BackEndUploading::getUserDetails()['user_id'];

// Check if we're logged in at all
if (login_check($mysqli) !== true) {
	header('Location: index.php');
	return;
}

// Permission check: only allow user to access files in his/her/it's own directory
if (!startsWith($requestedFile, "files/" . $currentUserID)) {
	die("You are not authorized to delete this file/folder.");
}

if (!file_exists($requestedFile)) {
	header('Location: /uploading.php');
	exit;
}

if (is_dir($requestedFile)) {
	echo "BOOM";
	array_map('unlink', glob("$requestedFile/*"));
	rmdir($requestedFile);
} else {
	unlink($requestedFile);
}

header('Location: /uploading.php');
