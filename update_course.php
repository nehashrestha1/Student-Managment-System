<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Add exit to stop further execution
} elseif ($_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit(); // Add exit to stop further execution
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['Course_id'])) {
    $t_id = mysqli_real_escape_string($data, $_GET['Course_id']); // Sanitize input
    $sql = "SELECT * FROM Courses WHERE id='$t_id'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        $info = mysqli_fetch_assoc($result);
    } else {
        die("Error: " . mysqli_error($data));
    }
}

if (isset($_POST['update_Course'])) { // Corrected the form field name
    $id = mysqli_real_escape_string($data, $_POST['id']); // Sanitize input
    $t_name = mysqli_real_escape_string($data, $_POST['name']); // Sanitize input
    $t_des = mysqli_real_escape_string($data, $_POST['description']); // Sanitize input

    // Use prepared statements to prevent SQL injection
    $sql2 = "UPDATE Course SET name=?, description=? WHERE id=?";
    $stmt = mysqli_prepare($data, $sql2);
    mysqli_stmt_bind_param($stmt, "ssi", $t_name, $t_des, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: admin_view_Course.php');
        exit(); // Add exit to stop further execution
    } else {
        echo "Error updating Course: " . mysqli_error($data);
    }
}

mysqli_close($data); // Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <?php
    include 'admin_css.php';
    ?>
    <style type="text/css">
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .form_deg {
            background-color: skyblue;
            width: 600px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
<?php
include 'admin_sidebar.php';
?>
<div class="content">
    <center>
        <h1>Update Course Data</h1><br><br>
        <form class="form_deg" action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
            <div>
                <label>Course Name</label>
                <input type="text" name="name" value="<?php echo $info['name']; ?>">
            </div>
            <div>
                <label>About Course</label>
                <textarea name="description" rows="4"><?php echo $info['description']; ?></textarea>
            </div>
            <div>
                <input class="btn btn-success" type="submit" name="update_Course">
            </div>
        </form>
    </center>
</div>
</body>
</html>
