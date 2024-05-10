<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection code here
$host = "localhost";
$user = "root";
$password = "";
$db = "collegeproject";
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

$user_data = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user profile in the database
    $update_sql = "UPDATE user SET name = '$name', email = '$email', phone = '$phone' WHERE id = $user_id";
    $update_result = mysqli_query($conn, $update_sql);

    if (!$update_result) {
        die("Error: " . mysqli_error($conn));
    }
    
    // Redirect to the profile page
    header("Location: student_profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Your Profile</h1>
    
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user_data['name']; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>"><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>"><br>

        <input type="submit" name="update_profile" value="Update Profile">
    </form>

    <a href="user_profile.php">Back to Profile</a>
    <a href="logout.php">Logout</a>
</body>
</html>
