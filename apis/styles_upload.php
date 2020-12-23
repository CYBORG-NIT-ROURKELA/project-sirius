<?php 
session_start();
include 'db.php';
function validateRGBColor($color) {
	if ($color == '') {

		echo(json_encode(array('status' => 'failure', 'result' => 'RGB color values are required')));
		return 0;
	}
	if (!preg_match('/^[0-9]{0,3}$/', $color)) {

		echo(json_encode(array('status' => 'failure', 'result' => 'RGB color values should be 3 digit integer value')));
		return 0;
	}
	if ($color <0 || $color > 255) {

		echo(json_encode(array('status' => 'failure', 'result' => 'RGB color values range from 0 to 255')));
		return 0;
	}
	return 1;
}
function validateCoordinate($coordinate){
if($coordinate==""){
	echo(json_encode(array('status'=>'failure','result'=>'X and Y coordinates are required')));
return 0;

}else{
	if (!preg_match('/^[1-9][0-9]{0,12}$/', $coordinate)) {
		echo(json_encode(array('status' => 'failure', 'result' => 'Coordinates contain only numbers')));
		return 0;
	}
	return 1;
}
}
function validateSize($coordinate){
	if($coordinate=="" || $coordinate==0){
		echo(json_encode(array('status'=>'failure','result'=>'Size cannot be empty or zero')));
	return 0;
	
	}else{
		if (!preg_match('/^[1-9][0-9]{0,12}$/', $coordinate)) {
			echo(json_encode(array('status' => 'failure', 'result' => 'Size contains only numbers')));
			return 0;
		}
		return 1;
	}
	}
function validateStyle($fontstyle){
	if ($fontstyle == '') {

		echo(json_encode(array('status' => 'failure', 'result' => 'font style required')));
		return 0;
	}
	return 1;
}					

if($_SERVER["REQUEST_METHOD"] === "POST" )
	{
		$admin_id = $_SESSION['admin_id'];
		$fstyle = $_POST["fstyle"];
		$fsize = $_POST["fsize"];
		$rcolor = $_POST["rcolor"];
		$gcolor = $_POST["gcolor"];
		$bcolor = $_POST["bcolor"];
		$xcoordinate = $_POST["xcoordinate"];
		$ycoordinate = $_POST["ycoordinate"];
		

		if ( isset($fstyle) && isset($fsize) && isset( $rcolor) && isset($gcolor) && isset($bcolor) && isset($xcoordinate) && isset($ycoordinate)) 
		{
    
				$query1=mysqli_query($con,"SELECT * from template_preview where admin_fk='$admin_id'");
				$count=mysqli_num_rows($query1);
			
				if(mysqli_num_rows($query1)==0){
					echo(json_encode(array('status'=>'failure','result' => 'Upload a template before proceeding')));	         
				}else
		 		{
					if( validateStyle($fstyle) && validateSize($fsize) && validateRGBColor($rcolor) && validateRGBColor($gcolor) && validateRGBColor($bcolor)   && validateCoordinate($xcoordinate) && validateCoordinate($ycoordinate) )
					{
						$font_type=mysqli_real_escape_string($con, $fstyle);
						$font_size=mysqli_real_escape_string($con, $fsize);
						$font_color=mysqli_real_escape_string($con, $rcolor.",".$gcolor.",".$bcolor);
						$x_coordinate = mysqli_real_escape_string($con, $xcoordinate);
						$y_coordinate = mysqli_real_escape_string($con, $ycoordinate);
						

		  				$q = "UPDATE template_preview SET font_type='".$font_type."', font_size='".$font_size."', font_color='".$font_color."', x_coordinate='".$x_coordinate."', y_coordinate='".$y_coordinate."' WHERE admin_fk ='".$admin_id."'";
		  
		  				$query = mysqli_query($con, $q);

						if ($query) {

							$query = mysqli_query($con, 'SELECT * FROM template_preview WHERE admin_fk="'.$admin_id.'"');
							$certificate_preview = mysqli_fetch_array($query,MYSQLI_ASSOC);
							$result = (object) [
								'certificate_preview'=>$certificate_preview,
							];
			 			 	echo(json_encode(array('status'=>'success','result'=>$result)));
						
						}
		  			}
	  				else
	  				{
		  				echo(json_encode(array('status'=>'failure','result' => 'Validation failed')));
	  				}
		 	}
		}else
		 {
		 	echo(json_encode(array('status'=>'failure','result' => 'Fill all fields')));
		 }
	}
	else{
		echo(json_encode(array('status'=>'failure','result' => 'not a post request')));
	}

?>
