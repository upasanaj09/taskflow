<?php
session_start();
if(isset($_SESSION['role']) && isset( $_SESSION['id']) && $_SESSION['role']=='admin'){
	include "DB_connection.php";
	include "app/model/Task.php";
	include "app/model/User.php";

    $users = get_all_users($conn);

	if(!isset($_GET['id'])){
		header("Location: tasks.php");
		exit();
	}
	$id= $_GET['id'];
	$task = get_task_by_id($conn, $id);
	if($task==0){
		header("Location: tasks.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Task</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
    <style>
    .input-1 {
	    border: 2px solid #ccc;
	    width: 100%;
	    padding: 10px;
	    font-size: 15px;
	    outline: none;
	    border-radius: 5px;
	    display: block;
    }

    .input-1:focus{
	    border-color: #555;
    }
    .input-holder label{
	    margin-bottom:5px;
        display:block;
    }
    .form-1 {
	    width: 90%;
	    max-width: 500px;
	}
    </style>
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"?>
	<div class="body">
	<?php include "inc/nav.php"?>

		<section class="section-1">
		<h4 class="title">Edit Task <a href="tasks.php">Tasks</a></h4>
            <form class="form-1" method="POST" action="app/update-task.php">
			<?php if (isset($_GET['error'])) {?>
      	  	<div class="danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } ?>
                <div class="input-holder">
                    <label for="">Title</label>
                    <input type="text" value="<?=$task['title']?>" name="title" class="input-1" placeholder="Title"><br>
                </div>
                <div class="input-holder">
                    <label for="">Description</label>
                <textarea type="text" name="description" class="input-1" placeholder="description"><?=$task['description']?></textarea><br>
                </div>
				<div class="input-holder">
                    <label>Snooze</label>
                    <input type="date" name="due_date" class="input-1" value="<?=$task['description']?>" placeholder="due_date"><br>
                </div>
                <div class="input-holder">
                    <label>Assigned to</label>
                        <select name="assigned_to" class="input-1">
                            <option value="0">Select employee</option>
                            <?php if($users !=0){ 
                                foreach($users as $user){
                                    if($task['assigned_to']==$user['id']){ ?>
                                <option selected value="<?=$user['id']?>"><?=$user['full_name']?></option>

                                     <?php } else{  ?>
                                ?>
                                <option value="<?=$user['id']?>"><?=$user['full_name']?></option>
          
                            <?php  } } } ?>
                        </select><br>
                </div>
				<input type="text" name="id" value="<?=$task['id']?>" hidden >
                <button class="edit-btn">Update</button>
            </form>
		</section>
</div> 
<script type="text/javascript">
	var active=document.querySelector("#navList li:nth-child(4)");
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