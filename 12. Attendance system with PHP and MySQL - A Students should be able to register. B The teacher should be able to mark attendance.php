<?php
// config.php - Database Configuration
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle student registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $student_name = $_POST["student_name"];
    $student_username = $_POST["student_username"];
    $student_password = password_hash($_POST["student_password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (student_name, student_username, student_password) VALUES ('$student_name', '$student_username', '$student_password')";
    $conn->query($sql);
}

// Handle marking attendance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark_attendance"])) {
    $student_id = $_POST["student_id"];
    $date = date("Y-m-d");
    $status = $_POST["status"];

    $sql = "INSERT INTO attendance (student_id, date, status) VALUES ($student_id, '$date', '$status')";
    $conn->query($sql);
}

// Fetch student information
$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
</head>
<body>
    <h1>Attendance System</h1>

    <h2>Student Registration</h2>
    <form method="post" action="">
        <label for="student_name">Name:</label>
        <input type="text" name="student_name" required>
        <label for="student_username">Username:</label>
        <input type="text" name="student_username" required>
        <label for="student_password">Password:</label>
        <input type="password" name="student_password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <h2>Student List</h2>
    <ul>
        <?php
        while ($row = $result_students->fetch_assoc()) {
            echo "<li>{$row['student_name']} ({$row['student_username']})</li>";
        }
        ?>
    </ul>

    <h2>Mark Attendance for Today</h2>
    <form method="post" action="">
        <label for="student_id">Select Student:</label>
        <select name="student_id" required>
            <?php
            $result_students = $conn->query($sql_students); // Reset result set
            while ($row = $result_students->fetch_assoc()) {
                echo "<option value='{$row['student_id']}'>{$row['student_name']}</option>";
            }
            ?>
        </select>
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <button type="submit" name="mark_attendance">Mark Attendance</button>
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
