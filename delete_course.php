<?php
error_reporting(0);
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";

$data = mysqli_connect($host, $user, $password, $db);


if (isset($_GET['Course_id'])) 
{   
   // echo "Hello Course id";

    $course_id = $_GET['Course_id']; // Fix variable name
   // die($course_id);
    $sql = "DELETE FROM courses WHERE id='$course_id'";
    $result = mysqli_query($data, $sql);
    if ($result) 
    {
        $_SESSION['message'] = 'Delete course is successful';
        header("location: view_course.php");
        exit; 
    } 
    else
     {
        $_SESSION['message'] = 'Failed to delete course';
        header("location: view_course.php");
        exit;
    }
}
?>
