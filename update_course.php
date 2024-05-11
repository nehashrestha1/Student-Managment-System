<?php
// Always start the session first
session_start();

// Check if the user is not logged in or is a student, redirect them to the login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";

$data = mysqli_connect($host, $user, $password, $db);

// Check if the 'course_id' parameter is set in the GET request and sanitize it
if (isset($_GET['Course_id'])) {
    $c_id = mysqli_real_escape_string($data, $_GET['Course_id']); // Corrected variable name

    // Prepare and execute the delete statement
    $sql2 = "DELETE FROM courses WHERE id=?";
    $stmt = mysqli_prepare($data, $sql2);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $c_id);
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['message'] = 'Delete course is successful';
        } else {
            $_SESSION['message'] = 'Failed to delete course';
        }

        mysqli_stmt_close($stmt);
        
        // Redirect back to view_course.php after deletion
        header('location: view_course.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error deleting course';
    }
}

// Fetch all courses from the database
$sql = "SELECT * FROM courses";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        .table_th {
            padding: 20px;
            font-size: 20px;
        }
        .table_td {
            padding: 20px;
            background-color: skyblue;
        }
    </style>
</head>
<body>
<?php include 'admin_sidebar.php'; ?>
<div class="content">
    <center>
        <h1>View All Course Data</h1>
        <table border="1px">
            <tr>
                <th class="table_th">Course Name</th>
                <th class="table_th">Description</th>
                <th class="table_th">Course id</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>
            <?php
            while ($info = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="table_td"><?php echo $info['name'] ?></td>
                    <td class="table_td"><?php echo $info['description'] ?></td>
                    <td class="table_td"><?php echo $info['courseid'] ?></td>
                    <td class="table_td">
                        <a onClick="return confirm('Are you sure to delete?');" class="btn btn-danger" 
                        href="delete_course.php?Course_id=<?php echo $info['id'] ?>">Delete</a>
                    </td>
                    <td class="table_td">
                        <a href="update_course.php?Course_id=<?php echo $info['id'] ?>" class="btn btn-primary">Update</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </center>
</div>
</body>
</html>
