<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 50px;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 400px;
        margin: auto;
    }

    h1 {
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    input[type="number"] {
        width: 50px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .result {
        margin-top: 20px;
        font-size: 24px;
        color: #007bff;
    }
</style>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 50px;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 400px;
        margin: auto;
    }

    h1 {
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    input[type="number"] {
        width: 50px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .result {
        margin-top: 20px;
        font-size: 24px;
        color: #007bff;
    }
</style>


</head>
<body>
    <h1>Electricity Bill Calculator</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $units = $_POST["units"];
        $total_cost = calculate_cost($units);
        echo "<div class='result'>Total Cost: Rs. " . $total_cost . "</div>";

            echo "<div class='bill-container'>";
            echo "<h2>Electricity Bill</h2>";
            echo "<p>Units Consumed: $units</p>";
            echo "<p>Total Cost: Rs. $total_cost</p>";
            echo "<button class='print-button' onclick='printBill()'>Print Bill</button>";
            echo "</div>";
    }

    function calculate_cost($units) {
        if ($units <= 50) {
            return $units * 3.50;
        } elseif ($units <= 150) {
            return 50 * 3.50 + ($units - 50) * 4.00;
        } elseif ($units <= 250) {
            return 50 * 3.50 + 100 * 4.00 + ($units - 150) * 5.20;
        } else {
            return 50 * 3.50 + 100 * 4.00 + 100 * 5.20 + ($units - 250) * 6.50;
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Units: <input type="number" name="units" required><br><br>
        <input type="submit" value="Calculate">
    </form>
    <script>
        function printBill() {
            window.print();
        }
    </script>
</body>
</html>