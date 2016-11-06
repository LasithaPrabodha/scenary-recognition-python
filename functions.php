<?php
ini_set('max_execution_time', 1000);
$target_dir = "images/uploads/";
$fileName = str_replace(' ','_',$_FILES["file_name"]["name"]);
$target_file = $target_dir . basename($fileName);
$uploadOk = 1;
$uploaddone = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file_name"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["file_name"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
        $uploaddone = 1;


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if($uploaddone == 1){
    $python = exec("python final_integration.py $fileName");
    echo $python;

}

