<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enrollment Record</title>
        <link ret="stylesheet" href="style.css">
    </head>
    <body>
        <ul class="navigation-bar">
            <li><a href="students.php">Student Record</a></li>
            <li><a href="courses.php">Student Record</a></li>
            <li><a href="instructor.php">Student Record</a></li>
            <li><a href="enrollment.php">Student Record</a></li>
        </ul>
        <div>

        </div class="status">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "studentrecord";
        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            die("Status: Connection failed: ". $conn->connect_error);
        }
        echo "Server Status: Connected successfully";
        ?>
        </div>

        <div class="card-style">
            <h1>Enrollment</h1>
            <table style="width:40%">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <tr><><td><label for="fname">Select Student:</label></td>
                    <td>
                    <select id="student" name="student">
                    <?php
                        echo "<br><hr>";

                        $sql = "SELECT *FROM student";
                        $result = $conn->query($sql);

                        if ($result) {

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=" . $row["StudentID"] . ">".$row["FirstName"]."</option>";
                                
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }?>
                    </select>
                    </td></tr>
                    <tr><td><label for="fname">Select Course</label>
                    </td>
                    <select id="course" name="course">
                    <?php
                        echo "<br><hr>";

                        $sql = "SELECT * FROM course";
                        $result = $conn->query($sql);

                        if ($result) {
                            while ($row->fetch_assoc()) {
                                echo "<option value=" . $row["CourseID"] . ">".$row["CourseName"]."</option>";
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }?>
                    </select>
                    </td></tr>
                    <>
            </form>
            </table>
    </body>
</html>