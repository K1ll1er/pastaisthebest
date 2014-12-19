<?php
// Helper function to check if a string starts with another string
function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

include_once 'includes/functions.php';

// Only start a session if we don't have one yet
if (session_status() == PHP_SESSION_NONE) {
    sec_session_start();
}

include_once 'includes/db_connect.php';
include_once 'includes/backenduploading.php';

// Load requested file and authorized user id
$requestedFile = $_GET['file'];
$currentUserID = BackEndUploading::getUserDetails()['user_id'];

// Check if we're logged in at all
if (login_check($mysqli) !== true) {
	header('Location: index.php');
	return;
}

// Permission check: only allow user to access files in his/her/it's own directory
if (!startsWith($requestedFile, "files/" . $currentUserID)) {
	die("You are not authorized to download this file.");
}

// If the file exists, send it to the user
// Using these headers, we force a file download instead of a display!
if (file_exists($requestedFile)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($requestedFile));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($requestedFile));
    ob_clean();
    flush();
    readfile($requestedFile);
    exit;
}