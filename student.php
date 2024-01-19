<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
        
        <link rel="stylesheet" href="style.css">
        
        <title>Student Record</title>
    </head>
    <body>\
        <ul class="navigation-bar">
            <li><a href="students.php"></a></li>
            <li><a href="courses.php"></a></li>
            <li><a href="instructor".php></a></li>
            <li><a href="enrollment.php"></a></li>
        </ul>
        <div class="status">
            <?php
            $servername = "localhost";
            $username = "root";
            $dbname = "studentrecord";

            $conn = new mysqli($servername, $username, $dbname);

            if ($conn->connect_error) {
                die("status: Connection failed: " . $conn->connect_error);
            } 
            echo "Server Status: Connected sucessfully";
            ?>
        </div>

        <div>
            <h1>Add Student Record</h1>
            <table>
                <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                    <tr><><td><label for="fname">First name:</label></td>
                    <td><input type="text" name="studentFname" id="studentFname" value=""></td></tr>
                    <tr><><td><label for="fname">Last name:</label></td>
                    <td><input type="text" name="studentLname" id="studentLname" value=""></td></tr>
                    <tr><><td><label for="fname">Date of Birth:</label></td>
                    <td><input type="text" name="studentDOB" id="studentDOB" value=""></td></tr>
                    <tr><><td><label for="fname">Email:</label></td>
                    <td><input type="text" name="studentEmail" id="studentEmail" value=""></td></tr>
                    <tr><><td><label for="fname">Phone:</label></td>
                    <td><input type="text" name="studentPhone" id="studentPhone" value=""></td></tr>
                    <tr><td></td><td><input type="submit" value="submit" name="addstudent"></td></tr>
                </form>
            </table>
        </div>
        <?php

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addstudent']))
        {
            try{
                $studentfname = $_POST['studentFname'];
                $studentlname = $_POST['studentLname'];
                $studentDOB = $_POST['studentDOB'];
                $studentemail = $_POST['studentEmail'];
                $studentphone = (int)$_POST['studentPhone'];
                $studentsql = "INSERT INTO student (FirstName,LastName,DateOfBirth,Email,Phone)
                                        VALUES(
                                        '$studentfname',
                                        '$studentlname',
                                        '$studentDOB',
                                        '$studentemail',
                                        $studentphone)";
                if (mysqli_query($conn, $studentsql)) {
                    echo "New record created successfully";
                } else {
                    echo "<br>Error: " . $studentsql . "<br>" . mysqli_error($conn);
                }
            }catch(PDOException $e) {
                echo $studentrecord . "<br>" . $e->getMessage();
            }
        
        }?>

        <div class="card-style">
            <h1>Students Records</h1>
            <table style="width:100%">
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Options</th>
            </tr>
            <?php

            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result) {

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["StudentID"] . "</td>"
                    . "<td>" . $row["FirstName"]. "</td>"
                    . "<td>" . $row["LastName"]. "</td>"
                    . "<td>" . $row["DateOfBirth"]. "</td>"
                    . "<td>" . $row["Email"]. "</td>"
                    . "<td>" . $row["Phone"]. "</td>"
                    . "<td><form method=".'POST'.">"
                    . "<input type=". 'hidden'." value=". '_method' ." name= " . "DELETE" ."/>"
                    . "<button type=".'submit'." value=". $row["StudentID"] . " name= " . 'deleteButton' . ">Delete</button>"
                    . "</form></td></tr>";
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }?>


            </table>
        </div>

    </body>