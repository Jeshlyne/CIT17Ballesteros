<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Record</title>
        <link ret="stylesheet" href="style.css">
    </head>
    <body>
        <ul class="navigation-bar">
            <li><a href="students.php">Student Record</a></li>
            <li><a href="courses.php">Student Record</a></li>
            <li><a href="instructor.php">Student Record</a></li>
            <li><a href="enrollment.php">Student Record</a></li>
        </ul>
    <div class="status">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "studentRecord";
        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            die("Status: Connection failed: ". $conn->connect_error);
        }
        echo "Server Status: Connected successfully";
        ?>
    </div>

    <div class="container">
        <div class="add-course">
            <h1>Add Course</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="coursename">Course Name:</label>
                <input type="text" naem="coursename" id="coursename" value="">
                <label for="coursecredits">Credits:</label>
                <input type="text" naem="coursecredits" id="coursecredits" value="">
                <input type="submit" value="Add Course" name="addcourse">
            </form>

        </div>
        

    </div>
    </body>
</html>