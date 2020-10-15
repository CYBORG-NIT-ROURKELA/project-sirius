<?php

    include('db.php');
    session_start();
	

    if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
    { 
    if(($_SESSION['logged_in']==1))   
        {
                 $admin_id = $_SESSION['admin_id'];
                $basicInfo=[];
                //basicInfo
                $query = mysqli_query($con, "SELECT * FROM admin where admin_id ='".$admin_id."'");
                if (mysqli_num_rows($query) == 0) {
                    return json_encode(array('status' => 'failure', 'result' => 'User ID not found'));
                } else {
                    $basicInfo = mysqli_fetch_array($query,MYSQLI_ASSOC); 
                    echo json_encode(array('status' => 'success', 'result' => $basicInfo));          
                }      
        }else
        {
            echo json_encode(array('status' => 'failure', 'result' => 'Not logged in'));
        }
   }else
   {
       echo json_encode(array('status' => 'failure', 'result' => 'Not logged in'));
   }
?>
