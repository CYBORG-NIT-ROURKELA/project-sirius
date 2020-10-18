<?php
include 'db.php';
    session_start();

function validateevent_name($event_name){
    if($event_name==""){
        echo(json_encode(array('status'=>'failure','message'=>'Event Name is needed')));
    return 0;

    }
    return 1;
}
function validateevent_dsc($event_dsc){
    if($event_dsc==""){
        echo(json_encode(array('status'=>'failure','message'=>'Event Description is needed')));
    return 0;

    }
    return 1;
}
function validateevent_date($event_date){
    if($event_date==""){
        echo(json_encode(array('status'=>'failure','message'=>'Event Date is needed')));
    return 0;

    }
    return 1;
}
function validateevent_org($event_org){
    if($event_org==""){
        echo(json_encode(array('status'=>'failure','message'=>'Event Organizer Details is needed')));
    return 0;

    }
    return 1;
}

function validateemail($email){
    if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
        echo(json_encode(array('status'=>'failure','message'=>'Proper Email is needed')));
    return 0;

    }
    return 1;
}

function validateName($name){
    // echo $name;
    if($name==''){
        echo(json_encode(array('status'=>'failure','message'=>'Name is required')));
        return 0;
    }

    if(!preg_match("/^[a-zA-Z ]+$/", $name)){
    echo(json_encode(array('status'=>'failure','message'=>' name should contain letters and spaces only')));
    return  0;
    }   
    return 1;
}


function validatePhone($phone) {
    if ($phone == '') {

        echo(json_encode(array('status' => 'failure', 'message' => 'Phone number is required')));
        return 0;
    }
    if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {

        echo(json_encode(array('status' => 'failure', 'message' => 'Phone number should have 10 digits and should start with 6,7,8, or 9')));
        return 0;
    }
    return 1;
}


   if (isset($_SESSION['logged_in'])&& isset($_SESSION['admin_id']))
    { 
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact_number=$_POST['contact_number'];
        $event_dsc = $_POST['event_dsc'];
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $event_org = $_POST['event_org'];
        $admin_id = $_SESSION['admin_id'];


        if(validateName($name) && validatePhone($contact_number) && validateemail($email) && validateevent_name($event_name) && validateevent_dsc($event_dsc) &&  validateevent_date($event_date) &&  validateevent_org($event_org))
        {
        $query1=mysqli_query($con,"SELECT * from admin where email='$email'");
        $count=mysqli_num_rows($query1);
        if($count!=0)
        {
            $query = mysqli_query($con, "UPDATE admin SET name='$name',email='$email',contact='$contact_number',event_name='$event_name',event_description='$event_dsc',event_date='$event_date',event_organiser='$event_org' WHERE  email ='".$email."'");
             
              if ($query)
        {
            echo(json_encode(array('status'=>'success','message' => 'Validation success')));
        }
        else
        {
             echo(json_encode(array('status'=>'failure','message' => 'Error in updating value')));
        }
        }
        else
        {
             echo(json_encode(array('status'=>'failure','message' => 'Wrong Email Entry')));
        }
        
        
    }
         else
        {
             
        }
    }

        else
        {
           echo(json_encode(array('status'=>'failure','message' => 'Error in updating value1')));
        }



?>
