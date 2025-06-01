<style>
	.header .notification {
	position: relative;
	cursor: pointer;
}
.header .notification span{
	position: absolute;
	top: 5px;
	left: 5px;
	background: #C80000;
	padding: 1px;
	border-radius: 50%;
}
.header .notification:hover i{
	color: #127b8e;
}
.notification-bar {
	display: none; 
	width: 90%;
	max-width: 300px;
	position: absolute;
	right: 0;
	background: #eee;
	padding: 5px;
	border: 1px solid #262931;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.notification-bar ul li{
	list-style: none;
	margin-top: 10px;
}
.notification-bar ul li a{
	text-decoration: none;
	color: #000;
}

.notification-bar ul li:nth-child(even){
	background: #fff;
}
.open-notification {
	display: block;
}
</style>
<header class="header">
		<h2 class="u-name">Task <b>flow</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<span class="notification" id="notificationBtn">
			<i class="fa fa-bell" aria-hidden="true"></i>
			<span id="notificationNum">&nbsp;1&nbsp;</span>
		</span>
	</header>
	<div class="notification-bar" id="notificationBar">
		<ul id="notifications">
		
		</ul>
	</div>
<script> 
	var openNotification = false;
	const notification =()=>{
		let notificationBar=document.querySelector("#notificationBar");
		if(openNotification){
			notificationBar.classList.remove('open-notification');
			openNotification=false;
		}else{
			notificationBar.classList.add('open-notification');
			openNotification=true;
		}
	}
	let notificationBtn = document.querySelector("#notificationBtn");
	notificationBtn.addEventListener("click",notification);
</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function(){

       $("#notificationNum").load("app/notification-count.php");
       $("#notifications").load("app/notification.php");

   });
</script>
