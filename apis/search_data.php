<?php
include ('db.php');
session_start();
$data = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
$prefix=$_POST['kword'];
if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
{
    if(isset($prefix)){
        $admin_id = $_SESSION['admin_id'];
    
        $event_data = [];
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_name LIKE '%".$prefix."%' AND admin_fk ='" . $admin_id . "'");
        while ($row = mysqli_fetch_assoc($query))
        {
            $data[] = array(
                'user_name' => $row['user_name'],
                'email' => $row['email']
            );
        }
        echo (json_encode(array(
            'status' => 'success',
            'result' => $data
        )));
    }
    else
    {
        echo (json_encode(array(
            'status' => 'failure'
        )));
    }
    
}
else
    {
        echo (json_encode(array(
            'status' => 'failure',
            'result' => $data
        )));
    }
}
?>