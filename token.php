<?php
session_start();

// Verifica se la sessione è attiva e non è scaduta
if (!isset($_SESSION['loggedin']) || time() > $_SESSION['expire']) {
    header('Location: index.php');
    exit();
}

// Rigenerare l'ID della sessione per la sicurezza
session_regenerate_id(true);
$_SESSION['expire'] = time() + 1800; // Estendi la sessione di altri 30 minuti

$date = new DateTime('now', new DateTimeZone('CET'));

// Ottieni l'ora corrente in formato 'Y-m-d H:i:s'
$current_time = $date->format('d M Y H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gpi Tracker</title>
    <link rel="stylesheet" href="style.css">
    <style>
       
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #555;
            display: none; 
            justify-content: center;
            align-items: center;
            z-index: 9999; 
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #a5e78d; 
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div id="loading" class="loading-spinner">
        <div class="spinner"></div>
    </div>

   
    <nav class="navbar">
        <div class="navbar-left">
            <img src="/img/swift_26.png" alt="Logo" class="logo">
            <span class="navbar-text">
                <span class="text-part payment">gpi</span>
                <span class="text-part tracker">Tracker</span>
            </span>
            <form action="logout.php" method="POST" style="margin-left: 20px;">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
        <div class="navbar-right">
            <form class="search-form">
                <input type="text" placeholder="Search token" aria-label="Search">
                <button type="button" disabled>Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <div class="header-item"><p>Final status</p><h4>Pending</h4><p>Awaiting confirmation beneficiary</p></div>
            <div class="header-item"><p>Value date</p><h4>15 Oct 2024</h4><p>12:19 CET</p></div>
            <div class="header-item"><p>Instructed amount</p><h4>250.000.000,00 EUR</h4></div>
            <div class="header-item"><p>Tracking</p><h4>83129-538-61f-6212</h4></div>
            <div class="header-item"><p>API Signature</p><h4>Unknown</h4></div>
            <div class="header-item"><p>Total duration</p><h4>5hr 8min</h4></div>
        </div>

        <div class="branching-timeline">
            <h3>Transaction Timeline :</h3>
            <div class="timeline-item">
                <div class="timeline-point"></div>
                <div class="timeline-content">
                    <h4>Transaction Initiated</h4>
                    <p class="current-time">15 Oct 2024, 12:19 CET</p>
                </div>
                <div class="branch">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Payment Processed</h4>
                            <p class="current-time">15 Oct 2024, 12:43 CET</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Awaiting confirmation</h4>
                            <p><?php echo $current_time; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-box">
            <div class="node-square"></div>
            <div class="vertical-line"></div>
        </div>

        <div class="timeline">
            <div class="timeline-node">
                <div class="bank-details">
                    <h4>Citibank Switzerland, N.A.</h4>
                    <p>SWIFT: CBSWCHZZ</p>
                    <p>LOCATION: Switzerland</p>
                    <p>Payment: <span class="current-time">15 Oct 2024, 12:19 CET</span></p>
                </div>
            </div>
            <div class="timeline-node">
                <div class="bank-details">
                    <h4>INTERMEDIARY BANK #NODE 1</h4>
                    <p>Location: Poland</p>
                    <p>NODE: 29039402456</p>
                    <button class="expand-button">More Details</button>
                    <div class="expandable-content" style="display: none;">
                        <p>The token has been uploaded to the first API node. [MT799] </p>
                    </div>
                </div>
            </div>
            <div class="timeline-node">
                <div class="bank-details">
                    <h4>EUROPE BANK #NODE 2</h4>
                    <p>Location: Germany</p>
                    <p>NODE: 29039402393</p>
                </div>
            </div>
            <div class="timeline-node">
                <div class="bank-details">
                    <h4>Antigua Commercial Bank (ACB)</h4>
                    <p>SWIFT: ANCBAGAG</p>
                    <p>Location: Antigua &amp; Barbuda</p>
                    <p><span class="pending">Pending<span class="dots"></span></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loadingSpinner = document.getElementById('loading');
            const expandButtons = document.querySelectorAll('.expand-button');

      
            if (!document.cookie.includes('firstVisit')) {
                loadingSpinner.style.display = 'flex';
                const randomWaitTime = Math.floor(Math.random() * 11) + 10; 

                setTimeout(() => {
                    loadingSpinner.style.display = 'none'; 
                    document.cookie = 'firstVisit=true; max-age=' + 365 * 24 * 60 * 60 + '; path=/'; 
                }, randomWaitTime * 1000); 
            }

   
            expandButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const isExpanded = content.style.display === "block";
                    content.style.display = isExpanded ? "none" : "block";
                    button.textContent = isExpanded ? "More Details" : "Less Details";
                });
            });
        });
    </script>
</body>
</html>
