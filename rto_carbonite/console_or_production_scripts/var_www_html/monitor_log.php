<?php
header('Content-Type: text/html; charset=utf-8');

// Function to convert seconds into a human-readable format
function formatRTO($seconds) {
    if ($seconds < 60) {
        return $seconds . " seconds";
    } elseif ($seconds < 3600) { // Less than an hour
        $minutes = floor($seconds / 60);
        $remaining_seconds = $seconds % 60;
        return $minutes . " min " . $remaining_seconds . " sec";
    } else { // An hour or more
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remaining_seconds = $seconds % 60;
        return $hours . " hr " . $minutes . " min " . $remaining_seconds . " sec";
    }
}

// Function to generate random color
function generateRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// Load server names from file
$serverFile = 'servers.txt';
$servers = file($serverFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Generate random colors for servers
$buttonColors = [];
foreach ($servers as $server) {
    $buttonColors[$server] = generateRandomColor();
}

// Start HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="icon" href="images/digiswitch.png" type="image/png"> <!-- Favicon -->
    <title>Digiswitch Infotech Pvt. Ltd.</title>
    <style>
        body {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .logo {
            animation: fadeInLogo 1s forwards;
            opacity: 0;
            animation-delay: 1s;
        }

        .title {
            animation: fadeInTitle 1s forwards;
            opacity: 0;
            animation-delay: 2s;
        }

        .buttons {
            animation: fadeInButtons 1s forwards;
            opacity: 0;
            animation-delay: 3s;
        }

        .log-output {
            animation: fadeInLogs 1s forwards;
            opacity: 0;
            animation-delay: 4s;
            max-height: 80vh; /* Set a max height for the log output area */
            overflow-y: scroll; /* Make the log output area scrollable */
        }

        .highlight {
            font-weight: bold;
            color: red;
            border: none; /* Ensure no border */
            background-color: transparent; /* Ensure transparent background */
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInLogo {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInTitle {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInButtons {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInLogs {
            to {
                opacity: 1;
            }
        }

        .btn-primary {
            border-color: transparent;
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4 logo">
            <!-- Add your logo here -->
            <img src="images/digiswitch.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
        </div>
        <h1 class="text-center mb-4 title">DRaaS - Recovery Time Objective (RTO) Dashboard</h1>
        <div class="text-center mb-4 buttons">
            <!-- Buttons to select the server -->
            <?php
            foreach ($servers as $server) {
                echo "<button class='btn btn-primary' style='background-color: {$buttonColors[$server]}; border-color: {$buttonColors[$server]};' onclick=\"loadLogData('$server')\">$server</button> ";
            }
            ?>
        </div>
        <div class="card">
            <div class="card-body">
                <pre class="log-output" id="logContainer">
                    <!-- Log content will be loaded here by JavaScript -->
                </pre>
            </div>
        </div>
    </div>
    <script>
        function loadLogData(server) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_log.php?server=' + encodeURIComponent(server), true); // Send the selected server name to the PHP script
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('logContainer').innerHTML = xhr.responseText;
                    var logContainer = document.getElementById('logContainer');
                    logContainer.scrollTop = logContainer.scrollHeight; // Auto-scroll to the bottom
                }
            };
            xhr.send();
        }

        // Initial load with a default server (e.g., ngdrs-ag)
        window.onload = function() {
            loadLogData('ngdrs-ag');
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

