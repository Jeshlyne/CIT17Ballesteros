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
    $dbname = "studentRecord";
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error . "<br>");
    }


    $sql = "CREATE DATABASES IF NOT EXISTS studentRecord";
    if ($conn->query($sql1) == TRUE) {
        echo "Databases created sucessfully<br.";
    } else {
        echo "Error creating databases: " ,$conn->error . "<br>";
    }
    
    $conn->select_db("studentRecord");

    $sql = "CREATE TABLE IF NOT EXISTS student (
        StudentID MEDIUMINT NOT NULL AUTO_INCREMENT,
        FirstName varchar(50) NOT NULL,
        LastName varchar(50),
        DateOfBirth date,
        Phone INT(11),
        PRIMARY KEY(StudentID)
    )";

    $sql = "CREATE TABLE IF NOT EXISTS course (
        CourseID MEDIUMINT NOT NULL AUTO_INCREMENT,
        CourseName varchar(100),
        Credits INT(255),
        PRIMARY KEY(CourseID)
    )";

    if ($conn->query($sql) == TRUE) {
        echo "Table course created sucessfully<br.";
    } else {
        echo "Error creating databases: " ,$conn->error . "<br>";
    }
    

    $sql = "CREATE TABLE IF NOT EXISTS instructor (
        IntructorID MEDIUMINT NOT NULL AUTO_INCREMENT,
        FirstName varchar(50) NOT NULL,
        LastName varchar(50),
        Email varchar(50),
        Phone INT(11),
        PRIMARY KEY(InstructorID)
    )";

    if ($conn->query($sql) == TRUE) {
        echo "Table instructor created sucessfully<br.";
    } else {
        echo "Error creating databases: " ,$conn->error . "<br>";
    }


    $sql = "CREATE TABLE IF NOT EXISTS enrollment (
        EnrollmentID MEDIUMINT NOT NULL AUTO_INCREMENT,
        StudentID MEDIUMINT,
        FOREIGN KEY (StudentID) REFERENCES student(StudentID),
        CourseID MEDIUMINT,
        FOREIGN KEY (CourseID) REFERENCES student(CourseID),
        EnrollmentDate date,
        PRIMARY KEY(EnrollmentID)
    )";


    if ($conn->query($sql) == TRUE) {
        echo "Table enrollment created sucessfully<br.";
    } else {
        echo "Error creating databases: " .  $conn->error . "<br>";
    }

    $conn->close();

    ?>

    </body>
</html>