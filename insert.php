<?php
include "config.php";

if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $emailCheckQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult && $emailCheckResult->num_rows > 0) {
        echo "Email already exists in the database.";
    } else {
        $sql = "INSERT INTO `users` (`firstname`,`lastname`,`email`,`password`,`gender`) VALUES ('$firstname','$lastname','$email','$hashedPassword','$gender')";
        $result = $conn->query($sql);

        if($result === TRUE){
            echo "Successfully inserted";
        }
        else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup Form</title>
</head>
<body>
    <h2>Signup Form</h2>
    <form action="" method="POST">
        <fieldset>
            <legend>Personal information:</legend>
            First name:<br>
            <input type="text" name="firstname" required><br>
            Last name:<br>
            <input type="text" name="lastname" required><br>
            Email:<br>
            <input type="email" name="email" required><br>
            Password:<br>
            <input type="password" name="password" required><br>
            Gender:<br>
            <input type="radio" name="gender" value="Male" required>Male
            <input type="radio" name="gender" value="Female" required>Female<br><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>