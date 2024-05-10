<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] === 'student') {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($data, $_POST['name']);
    $user_email = mysqli_real_escape_string($data, $_POST['email']);
    $user_phone = mysqli_real_escape_string($data, $_POST['phone']);
    $user_password = mysqli_real_escape_string($data, $_POST['password']);
    $user_Address = mysqli_real_escape_string($data, $_POST['Address']); // Fixed variable name

    $usertype = "student";

    $check = "SELECT * FROM user WHERE username='$username'";
    $check_user = mysqli_query($data, $check);

    $row_count = mysqli_num_rows($check_user);
    if ($row_count == 1) {
        echo "Username already exists. Try another one";
    } else {
        $sql = "INSERT INTO user (username, email, phone, usertype, password, Address) VALUES ('$username', '$user_email', '$user_phone', '$usertype', '$user_password','$user_Address')"; // Fixed variable name
        $result = mysqli_query($data, $sql);
        if ($result) {
            echo "Data Upload Successfully";
        } else {
            echo "Upload failed: " . mysqli_error($data); // Display the MySQL error message
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
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
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
            <h1>Add Student</h1>
            <div class="div_deg">
                <form action="#" method="post">
                    <div>
                        <label>Username</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" name="Address">
                    </div>
                    <div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>

</html>
