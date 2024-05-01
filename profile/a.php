<?php



// Set the timezone to 'Africa/Addis_Ababa' for Ethiopia
date_default_timezone_set('Africa/Addis_Ababa');

// Define the current time as a string
$current_time = "2024-05-01 08:13:03";

// Get the current Unix timestamp
$currentTimestamp = time();

// Convert the given time string to a Unix timestamp
$givenTimestamp = strtotime($current_time);

// Calculate the absolute difference in seconds
$timeDifference = abs($currentTimestamp - $givenTimestamp);

// Print the current timestamp, given timestamp, and absolute difference
echo "Current timestamp: $currentTimestamp\n";
echo "Given timestamp: $givenTimestamp\n";
echo "Time difference: $timeDifference\n";

// Determine if the time difference is within 120 seconds and output the result
echo ($timeDifference <= 120) ? "opacity-50\n" : "opacity-100\n";

echo (abs(time() - strtotime("2024-05-01 08:13:03")) <= 120) ? "opacity-50" : "opacity-100";




?>
