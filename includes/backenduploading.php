<?php
error_reporting(E_ALL);

// Only start a session / load the includes if we haven't done so yet (so we can safely include this file)
if (session_status() == PHP_SESSION_NONE) {
    include_once '../includes/db_connect.php';
    include_once '../includes/functions.php';
    sec_session_start();
}

class BackEndUploading
{
    // Static helper function to access user session details
    public static function getUserDetails()
    {
        $details['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : -1;

        $details['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : "";

        return $details;
    }

    // Upload the file to the user's folder
    public function uploadFile()
    {
        $userDetail = $this->getUserDetails();
        $targetDirectory = $_POST['dir'] == "" ? '../files/' . $userDetail['user_id'] . "/" : '../files/' . $userDetail['user_id'] . "/" . $_POST['dir'];

        if (!file_exists($targetDirectory)) {
			mkdir($targetDirectory);// create user's folder if it doesn't exist yet
		}
		
        move_uploaded_file($_FILES['myFile']['tmp_name'], $targetDirectory . "/" . $_FILES['myFile']['name']);

        header('Location: /uploading.php?dir=' . $_POST['dir']);
    }
}

// Sanity checks on the form input
try {

    $s = new BackEndUploading();

    if (isset($_FILES['myFile'])) {
      $s->uploadFile();
  }
} catch (Exception $e) {
    header("Content-type: application/json");

    print $e->getMessage();

    exit;
}