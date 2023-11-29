<?php
// config.php - Database Configuration
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ResultVit";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// index.php - Student List
$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester Results</title>
</head>
<body>
    <h1>Semester Results</h1>

    <h2>Student List</h2>
    <ul>
        <?php
        while ($row = $result_students->fetch_assoc()) {
            echo "<li><a href='?action=results&student_id={$row['student_id']}'>{$row['student_name']}</a></li>";
        }
        ?>
    </ul>

    <?php
    // results.php - Display Results
    if (isset($_GET['action']) && $_GET['action'] == 'results') {
        $student_id = $_GET['student_id'];
        $sql_student = "SELECT * FROM students WHERE student_id = $student_id";
        $result_student = $conn->query($sql_student);

        $sql_results = "SELECT * FROM results WHERE student_id = $student_id";
        $result_results = $conn->query($sql_results);

        if ($result_student->num_rows > 0) {
            $row_student = $result_student->fetch_assoc();
            echo "<h2>Results for {$row_student['student_name']}</h2>";
        } else {
            echo "<h2>Student not found</h2>";
        }
    ?>
    
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Marks</th>
        </tr>
        <?php
        while ($row_result = $result_results->fetch_assoc()) {
            echo "<tr>
                    <td>{$row_result['subject']}</td>
                    <td>{$row_result['marks']}</td>
                </tr>";
        }
        ?>
    </table>
    <?php } ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
