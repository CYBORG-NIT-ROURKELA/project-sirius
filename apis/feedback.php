<?php
session_start();
include 'db.php';
function validaterating($rating)
{
    if ($rating == "")
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'Rating'
        )));
        return 0;

    }
    return 1;
}
function validatecomments($comment_abt_event)
{
    if ($comment_abt_event == "")
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'Comment is necessary'
        )));
        return 0;

    }
    return 1;
}
function validatesuggestions($suggestions)
{
    if ($suggestions == "")
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'Suggestions is necessary'
        )));
        return 0;

    }
    return 1;
}

function validateName($name)
{
    // echo $name;
    if ($name == '')
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'Name is required'
        )));
        return 0;
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $name))
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => ' name should contain letters and spaces only'
        )));
        return 0;
    }
    return 1;
}

$name_user = $_POST['name_user'];
$email_id = $_POST['email_id'];
$rating = $_POST['rating'];
$suggestions = $_POST['suggestions'];
$comment_abt_event = $_POST['comment_abt_event'];

if (validateName($name_user) && validaterating($rating) && validatesuggestions($suggestions) && validatecomments($comment_abt_event))
{
    $query2 = mysqli_query($con, "SELECT * from user where email='".$email_id."'");
    $count1 = mysqli_num_rows($query2);
    $row3 = mysqli_fetch_assoc($query2);
    $unique_id=$row3['unique_id'];
    if ($count1 != 0)
    {
        $q1 = mysqli_query($con, "UPDATE user SET rating='$rating',comments_abt_event='$comment_abt_event',suggestions='$suggestions' WHERE  email ='" . $email_id . "'");
        $query_row = mysqli_fetch_array($query2,MYSQLI_ASSOC);
        $_SESSION['name']=$query_row['user_name'];
        $_SESSION['user_id']=$query_row['user_id'];
        $_SESSION['Email']=$query_row['email'];
        $_SESSION['admin_id']=$query_row['admin_fk'];
        if ($q1)
        {
            echo (json_encode(array(
                'status' => 'success',
                'message' => $unique_id
            )));
        }
        else
        {
            echo (json_encode(array(
                'status' => 'failure',
                'message' => 'Try Again'
            )));
        }
    }
    else
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'You are not registered'
        )));
    }

}

?>
