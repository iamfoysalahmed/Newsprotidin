<?php 
    include "config.php";
    
    if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
 }
    $user_id = $_GET['id'];

    $sql = "DELETE FROM user where user_id = {$user_id}";

    if(mysqli_query($connect, $sql)){
        header("Location: {$hostname}/admin/users.php");
    }else{
        echo "<p style='color:red; margin:10px 0px;'>Can\'t delete the user record </p>";
    }

    mysqli_close($connect);
?>