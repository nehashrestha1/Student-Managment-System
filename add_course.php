<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";
$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $courseid = $_POST['courseid']; // Changed 'course id' to 'courseid'
    $description = $_POST['description']; // Fixed the variable name here
   
    // You may want to validate and sanitize user inputs here to prevent SQL injection.

    $check = "SELECT * FROM courses WHERE name='$name'"; // Corrected SQL query
    $check_user = mysqli_query($data, $check);

    $row_count = mysqli_num_rows($check_user); // Changed $check_course to $check_user
    if ($row_count == 1) {
        echo "Name already exists. Try another one";
    } else {
        $sql = "INSERT INTO courses (name, courseid, description) VALUES ('$name', '$courseid', '$description')"; 
        $result = mysqli_query($data, $sql);
        if ($result) {
            header('location: add_course.php');
        } else {
            echo "Error: " . mysqli_error($data);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
    
<style type="text/css">
    label
    {
        display: inline-block;
        text-align: right;
        width: 100px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .div_deg
    {
        background-color: skyblue;
        width: 400px;
        padding-top: 70px;
        padding-bottom: 70px;
    }
    </style>
	<?php
include 'admin_css.php';
?>
</head>
<body>

	

	<?php
    include 'admin_sidebar.php';
    ?>


	<div class="content">
    <center>
		<h1>Add courses</h1>

        <div class="div_deg">
        <form action="#" method="POST" enctype="multipart/form-data"> 
<div>
    <label>Name</label>
    <input type= "text" name="name">
</div>
<div>
    <label>Course id</label>
    <input type= "courseid" name="courseid">
</div>
<div>
    <label>description</label>
    <textarea name="description"></textarea>
</div>

<div>
    
    <input type= "submit" name="add_course" class="btn btn-primary" value="Add course">
     </div>
     </form>
        </center>
	</div>

</body>
</html>

