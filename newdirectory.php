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
$currentUserID = BackEndUploading::getUserDetails()['user_id'];
$requestedFile = "files/" . $currentUserID . "/" . $_GET['target'];

// Check if we're logged in at all
if (login_check($mysqli) !== true) {
	header('Location: index.php');
	return;
}

// Permission check: only allow user to access files in his/her/it's own directory
if (!startsWith($requestedFile, "files/" . $currentUserID)) {
	die("You are not authorized to create this folder.");
}

// If this directory exists, do nothing
if (file_exists($requestedFile)) {
	header('Location: /uploading.php');
	exit;
}

// Create the new directory
mkdir($requestedFile);

// Redirect to the file overview page
header('Location: /uploading.php');
