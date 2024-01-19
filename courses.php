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

        <div class="edit-records">
            <?php
            $selecteditsql = "SELECT CourseID, CourseName, Credits FROM course";
            $result = $conn->query($selecteditsql);
            ?>
            <h1>Edit Records</h1>
            <form method="POST">
                <label for="course_id">Select Course</label>
                    <select name="course_id" id="course_id">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['CourseID'] . '">' . $row['CourseName'] ." "." (". $row['Credits'].") " . '</option>';
                            }
                        }
                        ?>
                    </select>
            </form>
            <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
            $selected_id = $_POST['course_id'];
            
            $editsql = "SELECT * FROM course WHERE CourseID = $selected_id";
            $result = $conn->query(($editsql));

            if ($result->num_rows > 0) {
                $editstudent =$result->fetch_assoc();

                ?>
                <form method="POST" action="courses.php">
                    <input type="hidden" name="ecourse_id" value="<?php echo $editstudent['CourseID']; ?>">
                    <label for="efirstname">Course Name:</label>
                    <input type="text" name="efirstname" value="<?php echo $esitstudent['CourseName']; ?>">
                    <label for="efirstname">Credit:</label>
                    <input type="text" name="elastname" value="<?php echo $esitstudent['Credit']; ?>">
                    <input type="submit" value="Update">
                </form>
                <?php
            } else {
                echo "No Courses foundwith this ID.";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
            $ucourse_id = $_POST['ecourse_id'];
            $ucoursename = $_POST['efirstname'];
            $ucredits = $_POST['elastname'];

            $eupdatesql = "UPDATE course SET CourseName='$coursename', Credits='$ucredits' WHERE CourseID='$ucourse_id'";

            if ($conn->query($eupdatesql) == TRUE) {
                echo "Course information updated successfully";
            }
        }
            

        ?>
        </div>
    </div>

    <div class="card-style">
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addcourse']))
        {
            try{
                $coursename = $_POST['coursename'];
                $coursecredit = (int)$_POST['coursecredits'];
                $coursesql = "INSERT INTO course (CourseName, Credits)
                                        VALUES(
                                        '$coursename', 
                                        '$coursecredit')";

                if (mysqli_query($conn, $coursesql)) {
                    echo "New record created successfully";
                } else {
                    echo "<br>Error: " . $studentsql . "<br>" . mysqli_error($conn);
                }
            }catch(PDOException $e) {
                echo $studentrecord . "<br>" . $e->getMessage();
            }
        }?>
        <table>
            <tr>
                <th>CourseID</th>
                <th>CourseName</th>
                <th>Credits</th>
                <th>Option</th>
            </tr>
            <?php
            
            $sql = "SELECT  * FROM course";
            $result = $conn->query($sql);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["CourseID"] . "</td>"
                    . "<td>" . $row["CouseName"]. "</td>"
                    . "<td>" . $row["Credits"]. "</td>"
                    . "<td><form method=". 'POST'.">"
                    . "<input type=".'hidden' ." value=". $row["CourseID"] ." name= " . 'deleteButton' .">Delete</button>"
                    . "</form></td></tr>";
                }
             } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
             }?>
        </table>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteButton'])) {
            $idToDelete = $_POST['deleteButton'];;

            $sql = "DELETE FROM course WHERE CourseID=$idToDelete";

            if ($conn->query($sql) == TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMCONtrntLoaded", function() {
            var deleteButtons = document.querySelectorAll('[name="deleteButton"]');

            deleteButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var courseIdToDelete = this.value;
                    var tableRow = this.closest('tr');

                    tableRow.parentNode.removeChild(tableRow);
                });
               

            });
        });
    </script>
    </body>
</html>


