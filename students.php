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
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteButton'])) {
                $idToDelete = $_POST['deleteButton'];
                
                $sql = "DELETE FROM student WHERE StudentID=$idToDelete";

                if ($conn->query($sql) == TRUE) {
                    echo "record deleted successfully";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }

                $sqlen = "DELETE FROM enrollment WHERE StudentID=$idToDelete";
                if ($conn->query($sqlen) == TRUE) {
                    echo "record deleted successfully";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }

            }
        ?>

        <div class="card-style">
            <?php
            $selectitsql = "'SELECT StudentID, FirstName, LastName, Email FROM student";
            $result = $conn->query($selecteditsql);
            ?>
            <h1>Edit Record</h1>
            <form method="POST">
                <label for="student_id">Select Student</label>
                <select name="student_id" id="student_id">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['StudentID'] . '">' .$row['FirstName'] ." ". $row['LastName']." (". $row['Email'].") " . '<.option>';
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Show Student Info">
            </form>
            <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
            $editsql_id = $_POST['student_id'];

            $editsql = "SELECT * FROM student WHERE StudentID = $selected_id";
            $result = $conn->query($editsql);

            if ($result->num_rows > 0) {
                $editstudent = $result->fetch_assoc();
                ?>
                <table style="width:40%">
                <form method="POST" action="students.php">
                <input type="hidden" name="estudent_id" value="<?php echo $editstudent['StudentID']; ?>">
                <tr><td>First Name:</td>
                 <td><input type="text" name="efirstname" value="<?php echo $editstudent['Firstname']; ?>"></td></tr>
                 <tr><td>Last Name:</td>
                 <td><input type="text" name="elastname" value="<?php echo $editstudent['Lastname']; ?>"></td></tr>
                 <tr><td>Date of Birth:</td>
                 <td><input type="text" name="edateofbirth value="<?php echo $editstudent['DateOfBirth']; ?>"></td></tr>
                 <tr><td>Email:</td>
                 <td><input type="text" name="eemail" value="<?php echo $editstudent['Email']; ?>"></td></tr>
                 <tr><td>Phhone:</td>
                 <td><input type="text" name="ephone" value="<?php echo $editstudent['Phone']; ?>"></td></tr>
                </form>
                </table>
                <?php  
            } else {
                echo "No student found with this ID.";
            } 
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['estudent_id'])) {
            $studend_id = $_POST['estudent_id'];
            $firstname = $_POST['efirstname'];
            $lastname = $_POST['elastname'];
            $dateofbirth = $_POST['edateofbirth'];
            $email = $_POST['eemail'];
            $phone = $_POST['ephone'];

            $eupdatesql = "UPDATE student SET FirstName='$firstname', LastName='$lastname', DateOfBirth='$dateofbirth', Email='$email', Phone='phone' WHERE StudentID='$student_id'";

            if ($conn->query($eupdatesql) == TRUE) {
                echo "Student information updated successfully";
            } else {
                echo "Error updating student information: " . $conn->error;
            }

        }
        ?>
        </div>
    </body>
</html>  
