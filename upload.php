<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['username'] == "")
{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEC Form with Upload Option</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>NEC Form with Upload Option</h2>
        <form id="necForm" enctype="multipart/form-data" action="upload_action.php" method="POST">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="document">Upload Document (PDF, PNG, JPEG):</label>
                <input type="file" class="form-control-file" id="document" name="document" accept=".pdf, .png, .jpeg, .jpg" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#necForm").submit(function (e) {
                e.preventDefault();
                const firstName = $("#firstName").val();
                const lastName = $("#lastName").val();
                const document = $("#document").val();
                
                if (firstName === "" || lastName === "") {
                    alert("First Name and Last Name are required fields.");
                    return;
                }

                if (!document.match(/\.(pdf|png|jpeg|jpg)$/i)) {
                    alert("Please upload a valid PDF, PNG, JPEG, or JPG file.");
                    return;
                }

                $("#necForm")[0].submit();
            });
        });
    </script>
</body>
</html>
