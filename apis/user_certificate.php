<?php

session_start();
include 'db.php';
if (isset($_SESSION['Email']) && isset($_SESSION['user_id'])){ 
        $id = $_SESSION['user_id'];
        $email = $_SESSION['Email'];
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_id='".$id."' AND email='".$email."'");
        $row = mysqli_fetch_assoc($query);
        $name = $row["user_name"];
        $rating=$row['rating'];
        $comments=$row['comments_abt_event'];
        $suggestions=$row['suggestions'];
        if($rating==""&&$comments==""&&$suggestions==""){ 
            echo(json_encode(array('status'=>'error','result' => 'Feedback form not filled')));
        }else{
            echo(json_encode(array('status'=>'success','result' => $name)));
        }

}else{
    echo(json_encode(array('status'=>'error','result' => 'You are not registered')));
}       
            
 
?>