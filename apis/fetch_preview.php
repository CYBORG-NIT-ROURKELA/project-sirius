<?php

	include('db.php');
	session_start();

	if(isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
	{
		if($_SESSION['admin_id'] != 0)
		try
		{
			$id = $_SESSION['admin_id'];
			$template_preview = [];

			$query = mysqli_query($con, "SELECT * FROM template_preview where admin_fk ='".$id."'");

			if (mysqli_num_rows($query) == 0) 
			{
				return json_encode(array('status' => 'failure', 'result' => 'admin_id not found'));
			}

			else
			{
				$template_preview = mysqli_fetch_array($query,MYSQLI_ASSOC);
			}
			$result = (object) [
                'template_preview'=>$template_preview,
			];
            echo json_encode(array('status' => 'success', 'result' => $result));
		}
		catch(Exception $e) 
        {
            echo json_encode(array('status' => 'failure', 'result' => $e->getMessage()));
        }
	}

?>