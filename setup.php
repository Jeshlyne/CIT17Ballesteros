<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Setup</title>
    </head>
    <body>
        <h1>Setup</h1>
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "StudentRecord";
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error . "<br>");
    }

    $sql = "CREATE DATABASES IF NOT EXISTS StudentRecord";
    if ($conn->query($sql1) == TRUE) {
        echo "Databases created sucessfully<br.";
    } else {
        echo "Error creating databases: " ,$conn->error . "<br>";
    }
    ?>
    </body>