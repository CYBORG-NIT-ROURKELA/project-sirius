<?php
include ('db.php');
session_start();
$data = array();
if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
{
    $admin_id = $_SESSION['admin_id'];
    
        $event_data = [];
        $query = mysqli_query($con, "SELECT * FROM user WHERE admin_fk ='" . $admin_id . "'");
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
            'status' => 'failure',
            'result' => $data
        )));
    }
?>