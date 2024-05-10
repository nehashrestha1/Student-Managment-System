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
if (isset($_GET['Course_id'])) { // Corrected variable name
    $c_id = mysqli_real_escape_string($data, $_GET['Course_id']); // Corrected variable name

    // Corrected SQL statement to use prepared statement to prevent SQL injection
    $sql2 = "DELETE FROM courses WHERE id=?";
    $stmt = mysqli_prepare($data, $sql2);

    if ($stmt) {
        // Bind the parameter and execute the statement
        mysqli_stmt_bind_param($stmt, "i", $c_id); // Corrected variable name
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header('location: view_course.php');
            exit();
        } else {
            // Handle the case where deletion failed, if necessary
            echo "Error deleting the course: " . mysqli_error($data);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the prepared statement couldn't be created
        echo "Error creating prepared statement: " . mysqli_error($data);
    }
}

// Rest of your code for displaying courses, if needed
$sql = "SELECT * FROM courses";
$result = mysqli_query($data, $sql);
?>

<!-- Place the HTML code for displaying courses here -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <?php
    include 'admin_css.php';
    ?>
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
<?php
include 'admin_sidebar.php';
?>
<div class="content">
    <center>
        <h1>View All Course Data</h1>
        <table border="1px">
            <tr>
                <th class="table_th">Course Name</th>
                <th class="table_th">About Course</th>
                <th class="table_th">Course id</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>
            <?php
            while ($info = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="table_td"><?php echo "{$info['name']}" ?></td>
                    <td class="table_td"><?php echo "{$info['description']}" ?></td>
                    <td class="table_td"><?php echo "{$info['courseid']}" ?></td>
                    <td class="table_td">
                        <?php
                        echo "
                        <a onClick=\"return confirm('Are you sure to delete?');\" class ='btn btn-danger' 
                        href='delete_course.php?Course_id={$info['id']}'>Delete</a>";
                        ?>
                    </td>
                    <td class="table_td">
                        <?php
                        echo "
                        <a href='update_course.php?Course_id={$info['id']}' class='btn btn-primary'>Update</a>";
                        ?>
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
