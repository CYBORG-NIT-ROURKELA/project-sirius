<?php

session_start();
include 'db.php';
if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
    { 
        $admin_id = $_SESSION['admin_id'];
        $name = $_SESSION['name'];
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
                $file = $name."_".$admin_id;
                imagejpeg($image, "../assets/img/certificates/" . $file . ".jpg");
                imagedestroy($image);
                $_SESSION['certificate'] = "../assets/img/certificates/" . $file . ".jpg";
                if(isset($_SESSION['certificate'])){
                    echo(json_encode(array('status'=>'success','result' => $file)));

                }
            }else{
                echo(json_encode(array('status'=>'error','result' => 'Styling variables not given')));
            }

        }else{
            echo(json_encode(array('status'=>'error','result' => 'Upload the template first')));
        }      
        
}
else
{
	echo(json_encode(array('status'=>'error','result' => 'Login to continue')));
}
?>