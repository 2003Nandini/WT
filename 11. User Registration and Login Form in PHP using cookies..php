<?php
// Function to handle user registration
function registerUser($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Insert user data into the 'users' table
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Function to handle user login
function loginUser($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Retrieve user data from the 'users' table
        $sql = "SELECT id, username, password FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row["password"])) {
                // Set a cookie for user authentication (replace '86400' with your desired expiry time)
                setcookie("user_id", $row["id"], time() + 86400, "/");
                echo "Login successful!";
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "User not found!";
        }
    }
}
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "Server";

// Connect to the database (replace with your actual database credentials)
$conn = new mysqli("localhost", "root", "", "Server");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Call registration and login functions
registerUser($conn);
loginUser($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>
</head>
<body>
    <h1>User Registration</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <h1>User Login</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
