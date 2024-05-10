<?php
error_reporting(0);
session_start();

$host = "localhost";
$user = "root"; 
$password = "";
$db = "collegeproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_GET['teacher_id'])) 
{
    $teacher_id = $_GET['teacher_id'];
    $sql = "DELETE FROM teacher WHERE id='$teacher_id'";
    $result = mysqli_query($data, $sql);
    if ($result) 
    {
        $_SESSION['message'] = 'Delete teacher is successful';
        header("location: admin_view_teacher.php");
        exit; 
    } 
    else
     {
        
        $_SESSION['message'] = 'Failed to delete teacher';
        header("location: admin_view_teacher.php");
        exit;
    }
}
?>
