<?php

include('db.php');
session_start();

if(isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
{
    if($_SESSION['admin_id'] != 0)
    try
    {
        $id = $_SESSION['admin_id'];
        $name = $_SESSION['name'];

        $query = mysqli_query($con, "SELECT * FROM template_preview where admin_fk ='".$id."'");

        if (mysqli_num_rows($query) == 0) 
        {
            return json_encode(array('status' => 'failure', 'result' => 'admin_id not found'));
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