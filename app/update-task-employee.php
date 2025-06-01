<?php 
session_start();
if(isset($_SESSION['role']) && isset( $_SESSION['id'])) {

if (isset($_POST['id']) && isset($_POST['status']) && $_SESSION['role']=='employee') {
	include "../DB_connection.php";

    function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$status = validate_input($_POST['status']);
	$id = validate_input($_POST['id']);
	$title=validate_input($_POST['title']);
	
	if (empty($status)) {
		$em = "Status is required";
	    header("Location: ../edit-task-employee.php?error=$em&id=$id");
	    exit();
	} else {
        include "model/Task.php";
		include "model/Notification.php";


        $data =array($status, $id);
        update_task_status($conn ,$data);

		$notif_data = array("$title task is $status ", "1" ,"Task Status Updated");
        insert_notification($conn ,$notif_data);

		$em = "Task updated successfully";
	    header("Location: ../edit-task-employee.php?success=$em&id=$id");
	    exit();
	}
} else {
   $em = "Unknown error occurred";
   header("Location: ../edit-task-employee.php?error=$em");
   exit();
}
} else{
	$em = "First login";
	header("Location: ../login.php?error=$em");
	exit();
}
