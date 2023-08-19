<?php 
include "config.php";

$sql = "SELECT * from users";
$result  = $conn->query($sql);

//   check value of varible in this code 
//  if ($result->num_rows > 0 ){
//     while ($row = $result->fetch_assoc()){
//         echo "ID: " . $row["id"] . " - Name: " 
//         . $row["firstname"] . "<br>" 
//         . $row["lastname"] . "<br>"
//          . $row["email"] . "<br>"
//         . $row["password"] . "<br>"
//         . $row["gender"] . "<br>";
//     }
//  }
// else
// {
//    echo "NO record found";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    
<div class="container">
    <h2> Users Details </h2>  
    <button type="button" class="btn btn-primary" onclick=reverse()>button</button>
    
    
    <table class="table">
        <thead>
        <tr>
            <td> S.No</td>
            <td> FIRST NAME </td>
            <td> LAST NAME </td>
            <td> EMAIL</td>
            <td> PASSWORD</td>
            <td> GENDER</td>
            <td> EDIT</td>
            <td> DELETE</td>
        </tr>
        </thead>


        <tbody>
           <?php 
           if($result->num_rows > 0){
             while ($row = $result->fetch_assoc()){
                // print_r($row) ;
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['firstname'];?></td>
                    <td><?php echo $row['lastname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td><?php echo $row['gender'];?></td>
                    <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp; </td>
                   <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php
           
             }
           }

           ?>
        



       
        </tbody>
    </table>
</div>
 <script>

    function reverse()
    {
        window.location.href = 'insert.php'
    }
 </script>



</body>
</html>

