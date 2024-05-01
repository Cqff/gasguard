<?php
// login.php
// $servername = "localhost:8888"; // Replace with your server name or IP
// $username = "root"; // Replace with your database username
// $password = ""; // Replace with your database password
// $dbname = "api"; // Replace with your database name

$servername = "database-1.cxzg4akd6dhy.ap-northeast-1.rds.amazonaws.com"; // Replace with your server name or IP
$username = "admin"; // Replace with your database username
$password = "Bk+w%H86"; // Replace with your database password
$dbname = "gasstation"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  // Protect against SQL injection
  $user = $conn->real_escape_string($user);
  $pass = $conn->real_escape_string($pass);

  // Query the database for user
  $sql = "SELECT * FROM customer WHERE CUSTOMER_Email = '$user'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      // VERIFY PASSWORD – Assume the password is stored using password_hash()
    //   if (password_verify($pass, $row["password"])) {
    //     // Start session, initialize any session variables
    //     session_start();
    //     //$_SESSION["loggedin"] = true;
    //     $_SESSION["email"] = $user;

    //     // Redirect user to welcome page
    //     header("Location: C:\web\welcome.html");
    //     exit;
    //   } else {
    //     echo "Invalid username or password.";
    //     exit;
    //   }

        $rows[] = $row;
        $cusRealPass = $row["CUSTOMER_Password"];
        //echo $cusRealPass;

        if($cusRealPass == $pass){
            // header("Content-Type: JSON");
            // echo "Welcome";
            // echo json_encode($rows, JSON_PRETTY_PRINT);
            header("Location: http://localhost/web/welcome.html");
            exit;
        }else{
            echo "failed";
            exit;
        }
    }
  } else {
    echo "error";
  }
}
$conn->close();
?>