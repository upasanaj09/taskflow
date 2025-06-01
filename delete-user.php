<?php
session_start();
if(isset($_SESSION['role']) && isset( $_SESSION['id']) && $_SESSION['role']=='admin'){
	include "DB_connection.php";
	include "app/model/User.php";
	if(!isset($_GET['id'])){
		header("Location: users.php");
		exit();
	}
	$id= $_GET['id'];
	$user = get_user_by_id($conn, $id);
	if($user==0){
        header("Location: users.php");
		exit();
	}
    $data=array($id,"employee");
    delete_user($conn, $data);
    $sm="Deleted successfully";
    header("Location: users.php?success=$sm");
	exit();
    
 } else{
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
 ?>