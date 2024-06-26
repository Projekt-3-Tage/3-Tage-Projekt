<?php
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
    $password = $_POST['password']; // Sicherheit: Hashen!
    $email = $_POST['email'];
    // SQL-Befehl zum Einfügen der Daten
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Neuer Benutzer wurde erfolgreich registriert.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Verbindung schließen
    $conn->close();
}
?>
<!-- HTML-Formular für die Registrierung -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Registrieren">
</form>











