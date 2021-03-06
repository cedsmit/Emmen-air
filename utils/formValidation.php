<?php

/**
 * return the name of the file that was assigned.
 */
function validateImageAndMove($img) {
  $fileName = $img['name'];
  $fileTmpName = $img["tmp_name"];
  $fileSize = $img['size'];
  $fileError = $img['error'];
  $fileType = $img['type'];

  $fileSaveName = uniqid();

  // make an numeric array with 2 values. example ["my-foto", "png"]
  $fileNameSplit = explode('.', $fileName);
  $fileExt = strtolower(end($fileNameSplit));

  $allowedExtension = array('jpg', 'jpeg', 'png');

  if(!in_array($fileExt, $allowedExtension)) {
    return false;
  }

  if($fileError !== UPLOAD_ERR_OK) {
    return false;
  }

  if($fileSize > 1000000) {
    return false;
  }

  $fileDestination = __DIR__ . "/../public/assets/uploaded_images/$fileSaveName.$fileExt";
  move_uploaded_file($fileTmpName, $fileDestination);

  return "$fileSaveName.$fileExt";
}

?>