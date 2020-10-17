<?php
include 'db.php';
    session_start();   
if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
    {
         if(($_SESSION['logged_in']==1)) 
         {
            function validaterating($rating){
    if($rating==""){
        echo(json_encode(array('status'=>'failure','message'=>'Rating')));
    return 0;

    }
    return 1;
}
function validatecomments($comment_abt_event){
    if($comment_abt_event==""){
        echo(json_encode(array('status'=>'failure','message'=>'Comment is necessary')));
    return 0;

    }
    return 1;
}
function validatesuggestions($suggestions){
    if($suggestions==""){
        echo(json_encode(array('status'=>'failure','message'=>'Suggestions is necessary')));
    return 0;

    }
    return 1;
}


function validateName($name){
    // echo $name;
    if($name==''){
        echo(json_encode(array('status'=>'failure','message'=>'Name is required')));
        return 0;
    }

    if(!preg_match("/^[a-zA-Z ]+$/", $name)){
    echo(json_encode(array('status'=>'failure','message'=>' name should contain letters and spaces only')));
    return  0;
    }   
    return 1;
}   
        $name_user=$_POST['name_user'];
        $email_id=$_POST['email_id'];
        $rating=$_POST['rating'];
        $suggestions=$_POST['suggestions'];
        $comment_abt_event = $_POST['comment_abt_event'];
        if(validateName($name_user) && validaterating($rating) && validatesuggestions($suggestions) && validatecomments($comment_abt_event))
        {
        $q = "INSERT INTO user(user_name, email, rating, comments_abt_event, suggestions) VALUES ('".$name_user."','".$email_id."','".$rating."','".$suggestions."','".$comment_abt_event."')";
                
        $query = mysqli_query($con, $q);
        if ($query)
        {
            echo(json_encode(array('status'=>'success','message' => 'Thank you very much')));
        }
        else
        {
             echo(json_encode(array('status'=>'failure','message' => 'Error in receiving suggestions')));
        }
        
        }
    
    }
    else
        {
             echo(json_encode(array('status'=>'failure','message' => 'Invalid Attempt')));
        }
}
else
        {
             echo(json_encode(array('status'=>'failure','message' => 'Invalid Attempt')));
        }



?>
