<?php
include "config.php";

if(isset($_POST['update'])){
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Check if the new email is already present in the table
    $checkEmailQuery = "SELECT COUNT(*) AS count FROM `users` WHERE `email` = '$email' AND `id` != '$user_id'";
    $emailCheckResult = $conn->query($checkEmailQuery);
    $emailCheckRow = $emailCheckResult->fetch_assoc();

    if ($emailCheckRow['count'] > 0) {
        echo "Error: Email already exists. Please choose a different email.";
    } else {
        $sql = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `password` = '$password', `gender` = '$gender' WHERE `id` = $user_id";

        $result = $conn->query($sql);

        if($result == TRUE){
            echo "Record Updated Successfully";

            // Add JavaScript to redirect after a delay
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'read.php';
                }, 2000); // 2 seconds delay
            </script>";
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if(isset($_GET['id'])){
    $user_id = $_GET['id']; // Add this line to get the user ID
    $sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
    $result1 = $conn->query($sql);

    if($result1->num_rows > 0){
        while($row = $result1->fetch_assoc()){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password  = $row['password'];
            $gender = $row['gender'];
            $id = $row['id'];
        }
    }
?>

<h2>User Update Form</h2>

<form action="" method="post">
    <fieldset>
        <legend>Personal information:</legend>
        First name:<br>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>">
        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
        <br>
        Last name:<br>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>">
        <br>
        Email:<br>
        <input type="email" name="email" value="<?php echo $email; ?>">
        <br>
        Password:<br>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <br>
        Gender:<br>
        <input type="radio" name="gender" value="Male" <?php if($gender == 'Male'){ echo "checked";} ?>>Male
        <input type="radio" name="gender" value="Female" <?php if($gender == 'Female'){ echo "checked";} ?>>Female
        <br><br>
        <input type="submit" value="Update" name="update">
    </fieldset>
</form> 

</body>
</html> 

<?php
} else { 
    header('Location: read.php');
} 
?>