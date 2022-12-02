<?php
require_once("utilities.php");

// ensure that an image has been submitted too
if (
    !isset($_POST["title"]) ||
    !isset($_POST["description"]) ||
    !isset($_FILES["image"]) ||
    empty($_FILES["image"]["tmp_name"])
) {
    exit("You must submit a title, a description and an image");
}


$title = htmlspecialchars($_POST["title"]);
$description = htmlspecialchars($_POST["description"]);

// check the mime type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$uploadedFile = $_FILES['image']['tmp_name'];
$fileMimeType = $finfo->file($uploadedFile);

$isAcceptedMimeType = in_array($fileMimeType, ['image/jpeg']);

if ($isAcceptedMimeType === false) {
    exit('You must upload an image in jpg format');
}

$imagesDir = __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

// create the images directory if it doesn't already exist
if (!file_exists($imagesDir) && !mkdir($imagesDir, 0777, true)) {
    exit('Failed to create image directory');
}

if (!is_writeable($imagesDir)) {
    exit('Cannot write to image directory');
}


$insertQuery = mysqli_query(
    $conn,
    "INSERT INTO tasks (title, description) VALUES ('$title', '$description')"
);

if (!$insertQuery) {
    exit('There was an error when inserting your task');
}

$taskId = mysqli_insert_id($conn);

$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$filepath = $imagesDir . $taskId . '.' . $ext;

// move the file to the images directory
$success = move_uploaded_file($uploadedFile, $filepath);

if (!$success) {
    exit("Error moving image - task $taskId - file $uploadedFile");
}



header('Location: /');
exit;



