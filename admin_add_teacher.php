<?php
session_start();
if(!isset($_SESSION['username']))
{
	header("location:login.php");
}
elseif($_SESSION['usertype']=='student')
{
	header("location:login.php");
}
$host="localhost";

$user="root";

$password="";

$db="collegeproject";


$data=mysqli_connect($host,$user,$password,$db);

if(isset($_POST['add_teacher']))
{
    $t_name=$_POST['name'];
    $t_description=$_POST['description'];
    $file=$_FILES['image']['name'];
    $dst="./image".$file;
    $dst_db="image/".$file;
    move_uploaded_file($_FILES['image']['tmp_name'],$dst);
    $sql="INSERT INTO teacher(name,description,image)Values('$t_name','$t_description','$dst_db')";
    $result=mysqli_query($data,$sql);
    if($result)
    {
        header('location:admin_add_teacher.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
    <style type="text/css">
        
        .div_deg
        {
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
	<?php
	include 'admin_css.php'
	?>
<body>

<?php
	include 'admin_sidebar.php';
?>


	

	<div class="content">
        <center>
		<h1>Add Teacher</h1>
        <div class="div_deg">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Teacher Name:</label>
                    <input type="text" name="name">
                    
                </div>
                
                <div>
                    <label>Description:</label>
                    <textarea name="description"></textarea>
                    
                </div>
                <div>
                    <label>Image:</label>
                    <input type="file" name="image">
                    
                </div>
                <div>
                    
                    <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
                    
                </div>
            </form>
        </div>
        </center>

	</div>

</body>
</html>

