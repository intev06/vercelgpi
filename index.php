<?php
session_start();

// Verifica se il token è stato inviato e se è corretto
if (isset($_POST['token']) && $_POST['token'] === '83129-538-61f-6212') {
    $_SESSION['loggedin'] = true;
    $_SESSION['start'] = time(); // tempo di inizio della sessione
    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60); // 30 minuti di durata
    header('Location: token.php');
    exit();
}

// Logout dell'utente
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

<html lang="it"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gpi Tracker</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #555;
            font-family: Arial, sans-serif;
        }
        .login-container {
            text-align: center;
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .logo {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 200px;
            border: 2px solid #007bff;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body style="background: #555;">
<link rel="stylesheet" href="style.css">
<div class="log" style="position: absolute;">
<div class="navbar-left" style="position: absolute;margin: -100px;">
<img src="/img/swift_26.png" alt="Logo" class="logo" style="margin-bottom: auto;">
            <span class="navbar-text">
                <span class="text-part payment">gpi</span>
                <span class="text-part tracker">Tracker</span>
            </span>
        </div>
     </div>
    <form method="POST" action="">
    <input type="text" name="token" placeholder="Insert token" required="" style="border: 2px solid #98d084;">
        <br>
        <input type="submit" value="Search">
    </form>
</div>

</body>
</html>
