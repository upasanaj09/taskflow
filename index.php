<?php
session_start();
if(isset($_SESSION['role']) && isset( $_SESSION['id'])){
	include "DB_connection.php";
	include "app/model/Task.php";
	include "app/model/User.php";
	if($_SESSION['role']=='admin'){
		$todaydue_task=count_tasks_due_today($conn);
		$overdue_task=count_tasks_overdue($conn);
		$nodeadline_task=count_tasks_no_deadline($conn);
		$num_task=count_tasks($conn);
		$num_users=count_users($conn);
		$pending=count_pending_task($conn);
		$inprogress=count_in_progress_task($conn);
		$completed=count_completed_task($conn);
	}else{
		$num_my_task=count_my_tasks($conn, $_SESSION['id']);
		$overdue_my_task=count_my_tasks_overdue($conn, $_SESSION['id']);	
		$nodeadline_my_task=count_my_tasks_no_deadline($conn, $_SESSION['id']);
		$pending=count_my_pending_task($conn,$_SESSION['id']);
		$inprogress=count_my_in_progress_task($conn,$_SESSION['id']);
		$completed=count_my_completed_task($conn,$_SESSION['id']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style2.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"?>
	<div class="body">
	<?php include "inc/nav.php"?>

		<section class="section-1">
			<?php if($_SESSION['role']== "admin"){ ?>
				<!-- Admin-dashboard -->
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-users"></i>
						<span><?=$num_users?> Employee(s)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span><?=$num_task?> All Tasks</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-window-close-o"></i>
						<span><?=$overdue_task?> Overdue</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-clock-o"></i>
						<span><?=$nodeadline_task?> No Deadline</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-exclamation-triangle"></i>
						<span><?=$todaydue_task?> Due Today</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-bell"></i>
						<span><?=$overdue_task?> Notifications</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-square-o"></i>
						<span><?=$pending?> Pending</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-spinner"></i>
						<span><?=$inprogress?> in progress</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-check-square-o"></i>
						<span><?=$completed?> Completed</span>
					</div>
				</div>
					<?php }else{ ?>
				<!-- Employee-dashboard -->
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span><?=$num_my_task?> My Tasks</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-window-close-o"></i>
						<span><?=$overdue_my_task?> Overdue</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-clock-o"></i>
						<span><?=$nodeadline_my_task?> No Deadline</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-square-o"></i>
						<span><?=$pending?> Pending</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-spinner"></i>
						<span><?=$inprogress?> in progress</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-check-square-o"></i>
						<span><?=$completed?> Completed</span>
					</div>
					<?php }?>
				</div>
			</section>
	</div>
<script>
	var active=document.querySelector("#navList li:nth-child(1)");
	active.classList.add("active");
</script>
</body>
</html>
<?php } else{
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
 ?>