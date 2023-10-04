<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = strip_tags(trim($_POST["firstName"]));
    $lastName = strip_tags(trim($_POST["lastName"]));

    // Process the uploaded file
    $uploadDir = "./"; // Directory to store uploaded files
    $uploadedFile = $_FILES["document"]["tmp_name"];
    $originalFileName = $_FILES["document"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $newFileName = uniqid().".".$fileExtension;

    $allowedExtensions = array("pdf", "png", "jpeg", "jpg");
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Invalid file type. Please upload a PDF, PNG, JPEG, or JPG file.";
    } else {
        if (move_uploaded_file($uploadedFile, $uploadDir.$newFileName)) {
            echo "Form submitted successfully!<br>";
            echo "First Name: ".$firstName."<br>";
            echo "Last Name: ".$lastName."<br>";
            echo "Uploaded File: ".$newFileName."<br>";
        } else {
            echo "Error uploading file.";
        }
    }
}
?>