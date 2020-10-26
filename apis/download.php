<?php

include('db.php');
session_start();

if((isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))||(isset($_SESSION['admin_id'])&&isset($_SESSION['name'])))
{
    if($_SESSION['admin_id'] != 0)
    try
    {
        $id = $_SESSION['admin_id'];
        $name = $_SESSION['name'];
        $query1 = mysqli_query($con, "SELECT * FROM template_preview where admin_fk ='".$id."'");
        $query2 = mysqli_query($con, "SELECT * FROM user where admin_fk ='".$id."' AND user_name ='".$name."'");

        if (mysqli_num_rows($query1) == 0) 
        {
            return json_encode(array('status' => 'failure', 'result' => 'admin id not found'));
        }else if(mysqli_num_rows($query2) == 0){
            return json_encode(array('status' => 'failure', 'result' => 'User details not found'));
        }
        else
        {
            $certificate=$name."_".$id.".jpg";         
            $filepath ="../assets/img/certificates/".$certificate;
            // echo $file;
            if(file_exists($filepath)) {
            header("Cache-Control: public");
		    header("Content-Description: File Transfer");
		    header("Content-Disposition: attachment; filename=$certificate");
		    header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");
            header("Pragma: no-cache"); 
            header("Expires: 0");
            readfile($filepath);
            exit;
            echo json_encode(array('status' => 'success', 'result' => 'Download successful'));
        }    else{
            echo json_encode(array('status' => 'error', 'result' => 'Upload template and font details before download'));
        }

        }
    }
    catch(Exception $e) 
    {
        echo json_encode(array('status' => 'failure', 'result' => $e->getMessage()));
    }
}

?>