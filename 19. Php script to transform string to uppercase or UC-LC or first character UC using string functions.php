<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

function transformString($inputString, $transformationType) {
    switch ($transformationType) {
        case 'UC':
            // Convert the entire string to uppercase
            $result = strtoupper($inputString);
            break;
        case 'LC':
            // Convert the entire string to lowercase
            $result = strtolower($inputString);
            break;
        case 'FCUC':
            // Capitalize the first character of the string
            $result = ucfirst(strtolower($inputString));
            break;
        default:
            $result = 'Invalid transformation type';
    }

    return $result;
}

// Example usage:
$inputString = 'hello, World!';
$transformationType = 'LC'; // Change this to 'LC' or 'FCUC' for different transformations

$result = transformString($inputString, $transformationType);

echo "Original String: $inputString <br>";
echo "Transformed String ($transformationType): $result";

?>

</body>
</html>