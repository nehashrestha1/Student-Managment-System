<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";

$data = mysqli_connect($host, $user, $password, $db);

$name = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username=?";
$stmt = mysqli_prepare($data, $sql);
mysqli_stmt_bind_param($stmt, 's', $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$info = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    $s_email = $_POST['Email'];
    $s_phone = $_POST['Phone'];
    $s_password = $_POST['password'];

    // Hash the password before updating it (use appropriate hashing method)
    // Example: $hashed_password = password_hash($s_password, PASSWORD_BCRYPT);

    $sql = "UPDATE user SET email=?, phone=?, password=? WHERE username=?";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $s_email, $s_phone, $s_password, $name);
    $result2 = mysqli_stmt_execute($stmt);

    if ($result2) {
        echo "Success";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <?php include 'student_css.php'; ?>
</head>
<body>
<?php include 'student_sidebar.php'; ?>
<style type="text/css">
    label {
        display: inline-block;
        width: 100px;
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .div_deg {
        background-color: skyblue;
        width: 500px;
        padding-top: 70px;
        padding-bottom: 70px;
    }
</style>
<div class="content">
    <center>
        <h1>Update Profile</h1>
        <form action="#" method="POST">
            <div class="div_deg">
                <div>
                    <label>Email</label>
                    <input type="email" name="Email" value="<?php echo htmlspecialchars($info['email']); ?>">
                </div>
                
                <div>
                    <label>Phone</label>
                    <input type="number" name="Phone" value="<?php echo htmlspecialchars($info['phone']); ?>">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($info['password']); ?>">
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" name="Phone" value="<?php echo htmlspecialchars($info['text']); ?>">
                </div>
                <div>
                    <input class='btn btn-primary' type="submit" name="update_profile" value="Update Profile">
                </div>
            </div>
        </form>
    </center>
</div>
</body>
</html>
