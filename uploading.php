<?php
include_once 'includes/functions.php';

if (session_status() == PHP_SESSION_NONE) {
	sec_session_start();
}

include_once 'includes/db_connect.php';
include_once 'includes/backenduploading.php';

if (login_check($mysqli) !== true) {
	header('Location: index.php');
	return;
}

$requestedDirectory = "";

$userRequestingDirectory = isset($_GET['dir']);
if ($userRequestingDirectory) {
	$requestedDirectory = "/" . $_GET['dir'];

	if (!file_exists("files/" . BackEndUploading::getUserDetails()['user_id'] . $requestedDirectory)) {
		$requestedDirectory = "";
		$userRequestingDirectory = false;
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	include_once 'includes/header.php';
	?>
	<div class="container">
		<div class="row">

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

				<form method="post" action="includes/backenduploading.php" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
					<input type="hidden" name="dir" value="<?php echo $requestedDirectory; ?>">
					<input type="file" name="myFile"><p></p>
					<p><input type="submit" name="submit" value="Start upload"></p>
				</form>

				<form method="get" action="newdirectory.php">
					<input type="text" name="target"><p></p>
					<p><input type="submit" name="submit" value="Create folder"></p>
				</form>

				<h1 class="page-header" id="fileheader">All Files</h1>

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>File name</th>
								<th>Uploaded</th>
								<th>Size</th>
								<th>Type</th>
								<th>Download</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>

							<?php
							// Read the user details from the session, we can trust them as they are database verified
							$userID = BackEndUploading::getUserDetails()['user_id'];

							if ($userRequestingDirectory) {
									// Print out link to parent directory
								echo "							
								<tr>
									<td>Main folder</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td><a href='uploading.php' type='button' class='btn btn-success'>Go to folder</a></td>
									<td></td>
								</tr>";
							}

							// We're putting this in a buffer so we can append folders to the top and files to the bottom
							$outputTable = "";

							$appendedRequestedDirectory = $requestedDirectory == "" ? "" : $requestedDirectory . "/";

							// Check if the user has ANY files: if so, we put them in a table!
							if (file_exists('files/' . $userID . $requestedDirectory) && $handle = opendir('files/' . $userID . $requestedDirectory)) {
								// The correct way to read and loop through a directory in php
								while (false !== ($entry = readdir($handle))) {
									// We don't need to show the top levels
									if ($entry != "." && $entry != "..") {
										// Get the file modified time, and format it the european way (woo europe)
										$filePath = 'files/' . $userID . "/" .  $appendedRequestedDirectory . $entry;
										$fileUploaded = date("d-m-Y H:i:s", filemtime($filePath));
										$fileSize = filesize($filePath) == 0 ? "-" : formatSizeUnits(filesize($filePath));
										$fileType = is_dir($filePath) ? "folder" : pathinfo($filePath, PATHINFO_EXTENSION);
										// Print it out in a table
										$toAppend = "							
										<tr>
											<td>$entry</td>
											<td>$fileUploaded</td>
											<td>$fileSize</td>
											<td>$fileType</td>
											";

											if (is_dir($filePath)) {
												$toAppend .= "<td><a href='uploading.php?dir=$requestedDirectory$entry' type='button' class='btn btn-success'>Go to folder</a></td>";
												$outputTable = $toAppend .  "<td><a href='delete.php?target=files/$userID/$appendedRequestedDirectory$entry' type='button' class='btn btn-danger'>Remove folder</a></td></tr>" . $outputTable;
											} else {
												$toAppend .= "<td><a href='userdownload.php?file=files/$userID/$appendedRequestedDirectory$entry' type='button' class='btn btn-success'>Download</a></td>";
												$outputTable .= $toAppend .  "<td><a href='delete.php?target=files/$userID/$appendedRequestedDirectory$entry' type='button' class='btn btn-danger'>Remove file</a></td></tr>";
											}
										}
									}
								}

								echo $outputTable;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>

