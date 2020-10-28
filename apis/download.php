<?php

include('db.php');
session_start();

if((isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))||(isset($_SESSION['user_id'])&&isset($_SESSION['name'])))
{
    try
    {  
        $name = $_SESSION['name'];
        if(isset($_SESSION['logged_in']) && isset($_SESSION['admin_id'])){
            $id = $_SESSION['admin_id'];
            $admin_id=$_SESSION['admin_id'];
            $query1 = mysqli_query($con, "SELECT * FROM template_preview where admin_fk ='".$admin_id."'");
            if (mysqli_num_rows($query1) == 0) 
            {
            return json_encode(array('status' => 'failure', 'result' => 'admin id not found'));
            }else{
            downloadCertificate($name,$id);
            }
        }else if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query2 = mysqli_query($con, "SELECT * FROM user where user_id ='".$id."' AND user_name ='".$name."'");
            if(mysqli_num_rows($query2) == 0){
                return json_encode(array('status' => 'failure', 'result' => 'User details not found'));
            }else{
                downloadCertificate($name,$id);
            }  
        }
        
    }
    catch(Exception $e) 
    {
        echo json_encode(array('status' => 'failure', 'result' => $e->getMessage()));
    }
}
function downloadCertificate($name,$id){
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
    }else{
        echo json_encode(array('status' => 'error', 'result' => 'Certificate not found'));
    }

}

?>