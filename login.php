<?php
$email = $_POST['email'];
$password = $_POST['password'];

// database connnection 
$con =new mysqli("localhost","root","","praise");
if($con->connect_error) {
    die("fail to connect : ".$con->connect_error);
}else{
    $stmt = $con->prepare("select * from register where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if($data['password'] == $password) {
            // Redirect to home page
            header("Location: courses.html");
            exit;
        } else{
            echo "<h2>Invalid Email or Password</h2>";

        }
    } else {
        echo "<h2>No user found with the given email</h2>";
    }
}
?>