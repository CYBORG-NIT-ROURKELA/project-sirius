<?php
include 'db.php';
session_start();
 if (isset($_SESSION['logged_in']) && isset($_SESSION['admin_id']))
    { 
    if($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_FILES["file"]["name"])))   
        {
	 $user_id=$_SESSION['admin_id'];
	 $file_name=$_FILES["file"]["name"];
     $file=$_FILES["file"]["tmp_name"];
     $ext=pathinfo($file_name,PATHINFO_EXTENSION);
      $extension = array('xlsx');
      $errors = array();
	if(in_array(strtolower($ext),$extension)){
		require('PHPExcel/PHPExcel.php');
		require('PHPExcel/PHPExcel/IOFactory.php');
		
		
		$obj=PHPExcel_IOFactory::load($file);
		foreach($obj->getWorksheetIterator() as $sheet){
			$getHighestRow=$sheet->getHighestRow();
			for($i=0;$i<=$getHighestRow;$i++){
				$name=$sheet->getCellByColumnAndRow(0,$i)->getValue();
				$email=$sheet->getCellByColumnAndRow(1,$i)->getValue();
				if($name!=''){
					
					$query2 = mysqli_query($con, "SELECT * from admin where admin_id='".$user_id."'");
					$row1 = mysqli_fetch_assoc($query2);
					$unique_id1=$row1['event_name'];
					$c = $name."_".$unique_id1;
					mysqli_query($con,"insert into user(unique_id,user_name,email,admin_fk) values('$c','$name','$email',$user_id)");
					
				}
			}
			echo (json_encode(array('status' => 'success', 'message' => 'Validation success')));
		}
	}else{
		echo (json_encode(array('status' => 'failure', 'message' => $ext)));
	}
}
else
{
	echo (json_encode(array('status' => 'failure', 'message' => 'Error in updating value')));
}
}
else
{
	echo (json_encode(array('status' => 'failure', 'message' => 'Error in updating value')));
}
?>