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

// Don't do anything if the file doesn't exist
if (!file_exists($requestedFile)) {
	header('Location: /uploading.php');
	exit;
}

// Different actions for deleting folders and files
if (is_dir($requestedFile)) {
    // Delete folder contents
	array_map('unlink', glob("$requestedFile/*"));
    // Delete the now empty directory
	rmdir($requestedFile);
} else {
    // Delete the file
	unlink($requestedFile);
}

// Redirect to the file overview page
header('Location: /uploading.php');
