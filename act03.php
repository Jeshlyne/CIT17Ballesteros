<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity 3</title>
    </head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $servername = "StudentRecord";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connecting failed: " . $conn->connect_error);
        }

 
        //CREATE
        if(isset($POST['create'])) {
            $username = $_POST['$uername'];
            $email = $_POST['email'];

            $sql = "INSERTT INTO users (username, email) VALUE ('$usrname', '$email')";

            if ($conn->query($sql) == TRUE) {
                echo "Created $username";
        
            } else {
                echo "Error adding entity: " . $coon->error;
            }
        }

        //UPDATE
        if(isset($_POST['username'])) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $edited = 0;

            if ($username != null){
                $sql = "UPDATE users SET username='$username' WHERE id=$id";
                $conn->query($sql);
                $edited = 1;
            }

            if ($email != null){
                $sql = "UPDATE users SET email='$email' WHERE id=$id";
                $conn->query($sql);
                $edited = 1;
            }

            if ($edited == 1){
                echo "Updated id = $id";
            } else {
                echo "Error updating entity: " . $conn->error;
            }
        }



        //DELETE
        if(isset($_POST['id'])) {
            $id = $_POST['id'];

            $sql = "DELETE FROM users WHERE id = $id";
            if ($conn->query($sql) == TRUE) {
                echo "Deleted id = $id";
            } else {
                echo "Error deleting entity: " . $conn->error;
            }

        }

        echo "<br><br>";
        
        //READ
        $sql = "SELECT id, username, email FROM users";
        $result = $con->query($sql);

        if ($result->num_rows >  0) {
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. " - Username: " . $row["username"]. " - Emnail: " . $row["email"]. "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>

    <form method="post" action="act03.php">
        <h4>CREATE</h4>
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="create" placeholder="Create">
    </form>

    <form method="post" action="act03.php">
    <h4>UPDATE</h4>
        <input type="text" name="id" placeholder="ID">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="update" placeholder="Update">
    </form>

    <form method="post" action="act03.php">
    <h4>DELETE</h4>
        <input type="text" name="id" placeholder="ID">
        <input type="submit" name="delete" placeholder="Delete"> 
    </form>

</body>
</html>