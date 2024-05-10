<?php
session_start();
if (!isset($_SESSION['username'])) 
{
    header("location: login.php");
    exit(); 
} 
elseif ($_SESSION['usertype'] === 'student')
 { 
    
    header("location: login.php");
    exit(); 
}

$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";
$data = mysqli_connect($host, $user, $password, $db);
$id = $_GET['student_id'];
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $email = mysqli_real_escape_string($data, $_POST['email']); 
    $phone = mysqli_real_escape_string($data, $_POST['phone']); 
    $password = mysqli_real_escape_string($data, $_POST['password']);
    $Address = mysqli_real_escape_string($data, $_POST['Address']); 

    $query = "UPDATE user SET username='$name', email='$email', phone='$phone', password='$password', Address='$Address' WHERE id='$id'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
        header("location: view_student.php");
        exit(); 
    } else {
        echo "Update Failed: " . mysqli_error($data);
    }
}
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
            width: 100px;
            text-align: center;
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
</head>
<body>
<?php
include 'admin_sidebar.php';
?>
<div class="content">
    <center>
        <h1>Update Student</h1>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label>Username</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($info['username']); ?>">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>">
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>">
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password" value="<?php echo htmlspecialchars($info['password']); ?>">
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" name="Address" value="<?php echo htmlspecialchars($info['Address']); ?>">
                </div>
                <div>
                    <input class="btn btn-success" type="submit" name="update" value="Update">
                </div>
            </form>
        </div>
    </center>
</div>
</body>
</html>
