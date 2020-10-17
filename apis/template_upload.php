<?php 
/* Getting file name */
include('db.php');
session_start();
if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
    { 
            $admin_id = $_SESSION['admin_id'];
            $query = mysqli_query($con, 'SELECT * FROM admin WHERE admin_id="'.$admin_id.'"');
            $row_query = mysqli_fetch_assoc($query);
            if($row_query["event_name"] == "" || $row_query["event_description"]=="" || $row_query["event_date"] == "" || $row_query["event_organiser"]=="") {
                echo(json_encode(array('status'=>'error','message' => 'Please fille the event form','result'=>'1')));
            }else{
                    if (isset($_FILES["file"]["name"])) {
                        $extension = array('jpg', 'jpeg', 'png' ,'bmp' ,'tiff' ,'gif', 'svg');
                        $errors = array();
                        $path = "../assets/img/templates/";
                        $uploadThisFile = true;
                        $file_name=$_FILES["file"]["name"];
                        $file_tmp=$_FILES["file"]["tmp_name"];
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                        // echo $ext;
                        // echo $file_name;
                        if(!in_array(strtolower($ext),$extension))
                        {
                            array_push($errors, "File type is invalid. Name:- ".$file_name);
                            $uploadThisFile = false;
                        }               
                        if($uploadThisFile){
                            $q = "SELECT admin_id,name FROM admin WHERE admin_id = '".$admin_id."'";
                            $r = mysqli_query($con, $q);
                            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
                            $name = $row["name"];
                            $oip=strval($name)."_".strval($admin_id).".".$ext; 
                            $ImagePath ="../assets/img/templates/".$oip;
                            if(file_exists($ImagePath))
                            { 
                                unlink($path.$oip);
                            }
                            $filename=strval($name)."_".strval($admin_id).".".$ext;
                            // $filepath=$path.$filename;
                            $Existance=mysqli_query($con,"SELECT template_image FROM template_preview WHERE admin_fk = '".$admin_id."'");
                            if (mysqli_num_rows($Existance) == 0) {
                                $q = "INSERT INTO template_preview (template_image, admin_fk ) VALUES ('".$filename."', '".$admin_id."')";
                                $query = mysqli_query($con, $q);

		                        if($query){
			                        echo(json_encode(array('status' => 'success', 'result' => "Template uploaded")));
		                        }
		                        else
		                        {
			                        echo(json_encode(array('status' => 'error', 'result' => mysqli_error($con))));
		                        }
                            }else{
                                $query1 = mysqli_query($con, "UPDATE template_preview SET template_image='".$filename."' WHERE admin_fk ='".$admin_id."'");
                                if ($query1) {
                                    move_uploaded_file($_FILES["file"]["tmp_name"],$path.$filename);
                                    echo(json_encode(array('status'=>'success','result' => 'Template updated')));
                                }
                                else
                                {
                            	    echo(json_encode(array('status'=>'error','result' => 'Problem while uploading')));
                                }
                            }
                        }
                        else
                        {
                            echo(json_encode(array('status'=>'error','result' => 'Not an image')));
                        }
                    
        }
        else
        {
            echo(json_encode(array('status'=>'error','result' => 'No file selected'))); 
        }
    }

}
else
{
	echo(json_encode(array('status'=>'error','result' => 'Login to continue')));
}
?> 