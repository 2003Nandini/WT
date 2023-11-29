<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
</head>
<body>

    <h1>Currency Converter</h1>

    <form action="" method="post">
        <label for="amount">Amount:</label>
        <input type="text" name="amount" required>
        
        <label for="from_currency">From Currency:</label>
        <select name="from_currency" required>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <!-- Add more currency options as needed -->
        </select>
        
        <label for="to_currency">To Currency:</label>
        <select name="to_currency" required>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <!-- Add more currency options as needed -->
        </select>
        
        <button type="submit">Convert</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST["amount"];
        $from_currency = $_POST["from_currency"];
        $to_currency = $_POST["to_currency"];

        // Replace 'YOUR_API_KEY' with your actual API key
        $api_key = 'YOUR_API_KEY';
        $api_url = "https://open.er-api.com/v6/latest?base=$from_currency&apiKey=$api_key";

        // Fetch exchange rates
        $exchange_rates_json = file_get_contents($api_url);
        $exchange_rates_data = json_decode($exchange_rates_json, true);

        // Check if the API request was successful
        if ($exchange_rates_data && $exchange_rates_data['result'] == 'success') {
            $rate = $exchange_rates_data['rates'][$to_currency];
            $converted_amount = $amount * $rate;

            echo "<p>$amount $from_currency is equal to $converted_amount $to_currency.</p>";
        } else {
            echo "<p>Error fetching exchange rates. Please try again later.</p>";
        }
    }
    ?>

</body>
</html>
