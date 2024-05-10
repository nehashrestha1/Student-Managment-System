<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}
elseif($_SESSION['usertype']=='admin')
{
	header("location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Dashboard</title>
	<style type="text/css">
		
</style>
	<?php
include'student_css.php';
?>
	
</head>


<?php
include'student_sidebar.php';
?>
	
	<div class="content">	
		<h2>GMMC</h2>
		<p>"YOU ARE ALLOWED TO CHANGE YOUR EMAIL AND PASSWORD"</p>
		<P>"THANK YOU"</P>
	</div>

</body>
</html>

