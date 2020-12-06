<?php

include 'db.php';
function validaterating($rating)
{
    if ($rating == "")
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'Feedback'
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
            'message' => 'Feedback'
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
            'message' => 'Feedback'
        )));
        return 0;

    }
    return 1;
}


$unique_id = $_POST['unique_id'];


    $query2 = mysqli_query($con, "SELECT * from user where unique_id='".$unique_id."'");
    $count1 = mysqli_num_rows($query2);
    if ($count1 != 0)
    {
        $row1 = mysqli_fetch_assoc($query2);
        $admin_id=$row1['admin_fk'];
        $email_id=$row1['email'];
        $id=$admin_id;
        $name=$row1['user_name'];
        $rating=$row1['rating'];
        $comment_abt_event=$row1['comments_abt_event'];
        $suggestions=$row1['suggestions'];
        if(validaterating($rating) && validatesuggestions($suggestions) && validatecomments($comment_abt_event))
        {
        $query = mysqli_query($con, "SELECT * FROM template_preview WHERE admin_fk='".$admin_id."'");
        if($query)
        {
            $row = mysqli_fetch_assoc($query);
            $templateName=$row['template_image'];
            $template="../assets/img/templates/".$templateName;
            $fontSize = $row['font_size'];
            $textAngle=0;
            $xCoordinate=$row['x_coordinate'];
            $yCoordinate=$row['y_coordinate'];
            $textColor=$row['font_color'];
            $colors= explode(",", $textColor);
            $fontfile=$row['font_type'];
            $fontpath = "../assets/fonts/".$fontfile.".ttf";
            if (isset($template) && isset($fontSize) && isset($xCoordinate) &&isset($yCoordinate)&& isset($textColor) &&isset($fontpath)) {
                $font = realpath($fontpath);
                // echo $font;
                $path = $templateName;
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext=='jpg' || $ext=='jpeg')
                {
                    $image = imagecreatefromjpeg($template);
                }else if($ext=='png'){
                    $image = imagecreatefrompng($template);
                }
                
                $color = imagecolorallocate($image, $colors[0], $colors[1], $colors[2]);
                imagettftext($image, $fontSize, $textAngle, $xCoordinate, $yCoordinate, $color, $font, $name);
                $file = $name."_".$id;
                imagejpeg($image, "../assets/img/certificates/" . $file . ".jpg");
                imagedestroy($image);
                $_SESSION['certificate'] = "../assets/img/certificates/" . $file . ".jpg";
                if(isset($_SESSION['certificate'])){
                    echo(json_encode(array('status'=>'success','result' => $file)));

                }
            }else{
                echo(json_encode(array('status'=>'error','result' => 'Try again later')));
            }

        }else{
            echo(json_encode(array('status'=>'error','result' => 'Try again later')));
        }
    }  
    else
    {
       
    }
    }
    else
    {
        echo (json_encode(array(
            'status' => 'failure',
            'message' => 'You are not registered'
        )));
    }



?>
