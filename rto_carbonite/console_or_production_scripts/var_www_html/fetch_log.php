<?php
header('Content-Type: text/plain; charset=utf-8');

// Get the selected server from the query parameter
$selected_server = isset($_GET['server']) ? $_GET['server'] : 'ngdrs-ag';

// Paths to the log files
$log_files = [
    'ngdrs-dc' => '/var/log/ngdrs-dc_rto.log',
    'ngdrs-dr' => '/var/log/ngdrs-dr_rto.log',
    'ngdrs-ag' => '/var/log/ngdrs-ag_rto.log',
    'mplds-vg' => '/var/log/mplds-vg_rto.log'
];

$log_contents = [];

if (array_key_exists($selected_server, $log_files) && file_exists($log_files[$selected_server])) {
    $lines = file($log_files[$selected_server], FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        // Check if the line contains 'RTO calculated' for the selected server
        if (strpos($line, "RTO calculated for $selected_server") !== false) {
            // Extract the seconds and service identifier
            preg_match("/RTO calculated for $selected_server: (\d+) seconds/", $line, $matches);
            
            if (isset($matches[1])) {
                // Format the RTO from seconds to a more readable format
                $formattedRTO = formatRTO($matches[1]);
                $line = str_replace($matches[1] . " seconds", $formattedRTO, $line);
            }
            // Highlight the line in bold red
            $log_contents[] = "<span class='highlight'>" . htmlspecialchars($line) . "</span>";
        }
    }
} else {
    $log_contents[] = "Log file for $selected_server not found.";
}

// Output the filtered log contents
foreach ($log_contents as $line) {
    echo $line . "\n";
}

// Function to convert seconds into a human-readable format
function formatRTO($seconds) {
    if ($seconds < 60) {
        return $seconds . " seconds";
    } elseif ($seconds < 3600) {
        $minutes = floor($seconds / 60);
        $remaining_seconds = $seconds % 60;
        return $minutes . " min " . $remaining_seconds . " sec";
    } else {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remaining_seconds = $seconds % 60;
        return $hours . " hr " . $minutes . " min " . $remaining_seconds . " sec";
    }
}
?>

