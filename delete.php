<?php
include "config.php";

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "DELETE FROM `users` WHERE `id`='$user_id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'read.php';
                }, 2000); // 2 seconds delay
            </script>";

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 
?>