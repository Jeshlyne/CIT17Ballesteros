<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Setup</title>
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

        <div class="card-style">
            <h1>As Instructor Record</h1>
            <table style="width:40%">
                <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                    <tr><><td><label for="fname">First name:</label></td>
                    <td><input type="text" name="insfname" id="insfname" value=""></td></tr>
                    <tr><><td><label for="fname">Last name:</label></td>
                    <td><input type="text" name="inslname" id="inslname" value=""></td></tr>
                    <tr><><td><label for="fname">Email:</label></td>
                    <td><input type="text" name="insemail" id="insemail" value=""></td></tr>
                    <tr><><td><label for="fname">Phone:</label></td>
                    <td><input type="text" name="insphone" id="insphone" value=""></td></tr>
                    <tr><td></td><td><input type="submit" value="submit" name="addinstructor"></td></tr>
                </form>
            </table>
        </div>

    </body>
</html>