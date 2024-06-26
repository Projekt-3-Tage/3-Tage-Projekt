<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verbindung zur Datenbank herstellen
    $servername = "localhost"; // oder IP-Adresse deines Servers
    $username = "root"; // Benutzername für MySQL
    $password = "Eisbombe11#"; // Passwort für MySQL
    $dbname = "freundebuch"; // Name deiner Datenbank
    // Verbindung aufbauen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Überprüfen, ob die Verbindung erfolgreich war
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }
    // Formulardaten abrufen und sicher verarbeiten
    $username = $_POST['username'];
    $password = $_POST['password'];
    // SQL-Befehl zum Überprüfen des Logins
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        // Benutzer gefunden
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login erfolgreich
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Falsches Passwort
            echo "Falsches Passwort.";
        }
    } else {
        // Benutzer nicht gefunden
        echo "Benutzername nicht gefunden.";
    }
    // Verbindung schließen
    $stmt->close();
    $conn->close();
}
?>
<!-- HTML-Formular für den Login -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>